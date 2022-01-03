<?php
namespace App\Crontab\Common\Flash;

use GuzzleHttp\Client;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use zxf5115\Upload\File;
use App\Models\Common\Module\Flash;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-07-12
 *
 * 快讯爬虫定时任务
 */
class Crawler extends Controller
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-07-12
   * ------------------------------------------
   * 爬取金色财经快讯信息
   * ------------------------------------------
   *
   * 爬取金色财经快讯信息
   *
   * @return [type]
   */
  public function action()
  {
    try
    {

      $ds = file_get_contents('https://finance.sina.com.cn/7x24/?tag=0');

      dd($ds);


      $url = getenv('GOLDEN_FINANCE_URL');

      $url = $url . time() . '&sign=' . md5(mt_rand(0, 999999));

      $http = new Client();

      $params = [
        "headers" => [
          "Accept" => "application/json, text/plain, */*",
          "Accept-Encoding" => "gzip, deflate, br",
          "Accept-Language" => "zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2",
          "Connection" => "keep-alive",
          "Content-Type" => "application/x-www-form-urlencoded",
          "Sec-Fetch-Dest" => "empty",
          "Sec-Fetch-Mode" => "cors",
          "Sec-Fetch-Site" => "same-site",
          "User-Agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:94.0) Gecko/20100101 Firefox/94.0",
        ],
        "allow_redirects" => [
          "Host" => "x-quote.cls.cn",
          "Origin" => "https://www.cls.cn",
          "Referer" => "https://www.cls.cn/",
        ]
      ];

      $response = $http->get($url, $params);

      if(200 == $response->getStatusCode())
      {
        $content = $response->getBody()->getContents();

        $result = json_decode($content, true);

        if(empty($result['data']) || empty($result['data']['roll_data']))
        {
          return false;
        }

        $data = $result['data']['roll_data'];

        foreach($data as $item)
        {
          $title       = $item['title'];
          $content     = $item['content'];
          $create_time = $item['ctime'];

          $where = [
            'title' => $title
          ];

          $flash = Flash::getRow($where);

          // 如果已存在标题一致的数据，跳过
          if(!empty($flash->id))
          {
            continue;
          }

          Flash::firstOrCreate([
            'category_id' => 1,
            'user_id'     => 1,
            'title'       => $title,
            'content'     => $content,
            'create_time' => $create_time,
          ]);
        }
      }
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      record($e);

      return false;
    }
  }
}
