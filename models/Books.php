<?php
    namespace app\models;

    use yii\db\ActiveRecord;

    class Books extends ActiveRecord
    {
        private $id;
        private $name;
        private $author;
        private $category;

        public function rules()
        {
            return [
                [ ['name', 'author','category'], 'required' ]

            ];
        }
    }



    ?>