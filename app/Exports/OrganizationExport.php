<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use Illuminate\Contracts\View\View;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 机构详情导出类
 */
class OrganizationExport implements FromView
{
  protected $data = null;

  /**
   * 初始化
   */
  public function __construct($data)
  {
    $this->data = $data;
  }


  public function view(): View
  {
      return view('/export/organization', ['data'=>$this->data]);
  }


}
