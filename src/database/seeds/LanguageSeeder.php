<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $languages = [
            [
                "label"      => "English",
                "code"       => "en",
                "is_default" => true,
            ],
            [
                "label" => "繁中",
                "code"  => "zh_HK"
            ],
            [
                "label" => "簡中",
                "code"  => "zh_CN"
            ],
        ];
        foreach ($languages as $language) {
            \Anacreation\School\Models\Language::create($language);
        }
    }
}
