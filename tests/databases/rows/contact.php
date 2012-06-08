<?php
class TestComMycomDatabaseRowContact extends PHPUnit_Framework_TestCase
{
    private $model;
    private $table;

    public function setUp(){
        $this->model = null;
        $this->table = 'contacts';
    }

    public function getModel(){
        $this->model = KService::get('com://site/mycom.model.' . $this->table);
        return $this->model;
    }

    public function test_save(){
        $orig_total = $this->getModel()->getTotal();

        $contact = array(
            "first_name" => "Juan",
            "last_name"  => "dela Cruz"
            "country"    => "Philippines"
            "phone"      => "999-9999"
        );

        KService::get('com://site/mycom.database.row.' . $this->table)
                    ->setData($contact)
                    ->save();

        $new_total = $this->getModel()->getTotal();

        $this->assertEquals(($orig_total + 1), $new_total, __METHOD__ . '() Failed');
    }
}
