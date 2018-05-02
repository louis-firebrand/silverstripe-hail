<?php

namespace Firebrand\Hail\Models;

class PrivateTag extends ApiObject
{
    public static $object_endpoint = "private-tags";
    private static $table_name = "HailPrivateTag";
    protected static $api_map = [
        'Name' => 'name',
        'Description' => 'description',
    ];
    private static $many_many = [
        'Articles' => 'Firebrand\Hail\Models\Article',
        'Publications' => 'Firebrand\Hail\Models\Publication',
        'Images' => 'Firebrand\Hail\Models\Image',
        'Videos' => 'Firebrand\Hail\Models\Video',
    ];
    private static $belongs_many_many = [
        'HailLists' => 'Firebrand\Hail\Lists\HailList',
    ];
    private static $db = [
        'Name' => 'Varchar',
        'Description' => 'Varchar',
    ];
    private static $searchable_fields = [
        'Name',
        'Description'
    ];
    private static $summary_fields = [
        'Organisation.Title' => 'Hail Organisation',
        'HailID' => 'Hail ID',
        'Name' => 'Name',
        'Description' => 'Description',
        'Fetched' => 'Fetched'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $this->makeRecordViewer($fields, "Articles", $this->Articles());
        $this->makeRecordViewer($fields, "Publications", $this->Publications());
        $this->makeRecordViewer($fields, "Images", $this->Images());
        $this->makeRecordViewer($fields, "Videos", $this->Videos());
        $fields->removeByName("HailLists");

        return $fields;
    }

    public function importHailData($data)
    {
        $this->Name = $data['name'];
        $this->Description = $data['description'];
        return parent::importHailData($data);
    }
}
