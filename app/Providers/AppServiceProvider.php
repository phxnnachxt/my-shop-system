<?php

namespace App\Providers;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }
    public function boot(): void
    {
        //
        Builder::macro('search', function ($fields, $string, $mode = 'contains', $condition = 'or') {
            // สร้างตัวแปร $query เพื่อเก็บอินสแตนซ์ Query Builder
            $query = $this;

            // ตรวจสอบว่าค่า $string เป็นค่าว่างหรือไม่
            if (empty($string)) {
                // ถ้าค่าว่าง ให้คืนค่า $query ออกไปเลย (ไม่มีการค้นหา)
                return $query;
            }

            // วนลูปผ่านแต่ละฟิลด์ที่ต้องการค้นหา
            foreach ($fields as $field) {
                // ตรวจสอบรูปแบบการค้นหาตามค่า $mode
                switch ($mode) {
                    case 'contains':
                        // ถ้าต้องการค้นหาแบบ "มีบางส่วนของคำที่ต้องการ"
                        // ให้ใช้คำสั่ง orWhere หรือ where ร่วมกับตัวดำเนินการ LIKE
                        // โดยขึ้นอยู่กับค่า $condition
                        $query = $condition === 'or'
                            ? $query->orWhere($field, 'like', '%' . $string . '%')
                            : $query->where($field, 'like', '%' . $string . '%');
                        break;
                    case 'exact':
                        // ถ้าต้องการค้นหาแบบ "ตรงตามคำที่ต้องการเป๊ะๆ"
                        // ให้ใช้คำสั่ง orWhere หรือ where ร่วมกับตัวดำเนินการ =
                        // โดยขึ้นอยู่กับค่า $condition
                        $query = $condition === 'or'
                            ? $query->orWhere($field, '=', $string)
                            : $query->where($field, '=', $string);
                        break;
                    case 'case-insensitive':
                        // ถ้าต้องการค้นหาแบบ "ไม่คำนึงถึงตัวพิมพ์"
                        // ให้ใช้คำสั่ง orWhere หรือ where ร่วมกับตัวดำเนินการ ILIKE (ถ้า database รองรับ)
                        // โดยขึ้นอยู่กับค่า $condition
                        $query = $condition === 'or'
                            ? $query->orWhere($field, 'LOWER(', '%' . $string . '%)')
                            : $query->where($field, 'LOWER(', '%' . $string . '%)');
                        break;
                }
            }

            // คืนค่า $query ที่ผ่านการใส่เงื่อนไขการค้นหาแล้ว
            return $query;
        });
    }
}
