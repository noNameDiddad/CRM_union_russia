<?php

namespace Database\Seeders;

use App\Data\ChapterData;
use App\Models\Chapter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($entity_id, $chapterName, $json, int $order): void
    {
        $chapter = ChapterData::from(
            $this->reformatJson($json, $chapterName) +
            ['name' => $chapterName, 'entity_id' => $entity_id, 'order' => $order]
        );
        Chapter::create($chapter->toArray());
    }

    private function reformatJson($json, $chapterName): array
    {
        $result = [];
        $specialFields = $json['specialFields'] ?? [];
        $result['isSubEntity'] = $json['isSubEntity'] ?? false;
        foreach ($json['fields'] as $item) {
            if (in_array($item, array_keys($specialFields))) {
                foreach ($specialFields[$item] as $key =>$specialField) {
                    $str = explode('.', $specialField);
                    $result['specialFields'][Str::slug($item)][] = $str[0].'.'.Str::slug($str[1]);
                }
            }
            $result['fields'][] = $json['entity'].'.'.Str::slug($item);

        }
        return $result;
    }
}
