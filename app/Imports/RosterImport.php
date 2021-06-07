<?php
namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


use App\Http\Constant\Code;
use App\Enum\Common\SexEnum;
use App\TraitClass\ToolTrait;
use App\Http\Constant\Parameter;
use App\Models\Common\Module\Member\Member;
use App\Models\Common\Module\Organization\Squad\Squad;
use App\Models\Common\Module\Organization\Squad\Relevance\Member as SquadMember;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-08-28
 *
 * 班级花名册导入类
 */
class RosterImport implements ToCollection, WithBatchInserts, WithChunkReading
{
  protected $squad_id = null;

  public function __construct($squad_id)
  {
    $this->squad_id = $squad_id;
  }

  public function collection(Collection $rows)
  {
    //如果需要去除表头
    unset($rows[0]);

    //$rows 是数组格式
    return $this->createData($rows);
  }




  /**
  * @param array $row
  *
  * @return \Illuminate\Database\Eloquent\Model|null
  */
  public function createData($rows)
  {
    try
    {
      $squad = Squad::getRow(['status' => 1, 'id' => $this->squad_id]);

      if(empty($squad->id))
      {
        return false;
      }

      $number = count($rows);

      $squad->number = $number;
      $squad->save();

      foreach ($rows as $row)
      {
        if(empty($row[1]) || empty($row[3]) || empty($row[4]))
        {
          continue;
        }

        $nickname   = $row[1];
        $sex        = SexEnum::getCode($row[2]);
        $username   = $row[3];
        $id_card_no = $row[4];

        $organization_id = auth('api')->user()->organization_id;

        $member = Member::firstOrNew(['username' => $username]);

        if(empty($member->id))
        {
          $member->organization_id = $organization_id;
          $member->nickname        = $nickname;
          $member->password        = Member::generate(Parameter::PASSWORD);
          $member->member_no       = ToolTrait::generateOnlyNumber(3);
          $member->avatar          = Parameter::AVATER;
          $member->mobile          = $username;
          $member->certification_status = 1;

          $member->save();

          $data = [
            [
              'organization_id' => $organization_id,
              'realname'        => $nickname,
              'id_card_no'      => $id_card_no,
              'sex'             => $sex
            ]
          ];

          // 机构学员资料
          $member->archive()->delete();
          $member->archive()->createMany($data);

          // 机构学员权限
          $data = [['organization_id' => $organization_id, 'role_id' => 3]];
          $member->relevance()->delete();
          $member->relevance()->createMany($data);
        }
        else
        {
          $member->organization_id = $organization_id;
          $member->save();
        }

        $data = [
          'organization_id' => $organization_id,
          'squad_id'        => $squad->id,
          'member_id'       => $member->id,
        ];

        (new SquadMember())->create($data);
      }

      return true;
    }
    catch(\Exception $e)
    {
      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-08-28
   * ------------------------------------------
   * 批量导入1000条
   * ------------------------------------------
   *
   * 多余1000条数据，一次只导入1000条，多次导入
   *
   * @return [type]
   */
  public function batchSize(): int
  {
      return 1000;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-08-28
   * ------------------------------------------
   * 以1000条数据基准切割数据
   * ------------------------------------------
   *
   * 以1000条数据基准切割数据
   *
   * @return [type]
   */
  public function chunkSize(): int
  {
      return 1000;
  }
}
