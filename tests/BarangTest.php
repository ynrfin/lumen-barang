<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BarangTest extends TestCase
{
    /**
     * Check if get / returns 200
     */
    public function testGetHome()
    {
        $this->get('/', []);

        $this->seeStatusCode('200');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testResouceCollectionFormat()
    {
        $response = $this->get('/', []);

        $this->seeStatusCode('200');

        $this->isJson();

        $this->seeJsonStructure([
            "data" => [
                [
                    [
                        "type",
                        "id",
                        "atttributes" => [
                            "kode",
                            "nama",
                            "deskripsi",
                            "harga",
                            "stok",
                            "created_at",
                            "updated_at"
                        ]
                    ]
                ],
            ],
            "links" => [
                "first",
                "last",
                "prev",
                "next"
            ],
            "meta" => [
                "current_page",
                "from",
                "last_page",
                "path",
                "per_page",
                "to",
                "total",
            ]
        ]);
    }

    /**
     * Check format output of get /{id} is correct
     */
    public function testResourceFormat()
    {
        $this->get('/3', []);

        $this->seeStatusCode('200');

        $this->isJson();

        $this->seeJsonStructure([
            'type',
            'id',
            'atttributes' => [
                'kode',
                'nama',
                'deskripsi',
                'harga',
                'stok',
                'created_at',
                'updated_at',

            ]

        ]);

    }

    /**
     * Check output datatype of get /{id} is correct
     */
    public function testResourceDatatype()
    {
        $response = $this->get('/3', [])->response->content();


        $response = json_decode($response, true);
        $attr = $response['atttributes'];


        $this->assertIsString($response['type']);
        $this->assertIsString($response['id']);

        $this->assertIsString($attr['kode']);
        $this->assertIsString($attr['nama']);
        $this->assertIsString($attr['deskripsi']);
        $this->assertIsInt($attr['harga']);
        $this->assertIsInt($attr['stok']);
        $this->assertIsString($attr['created_at']);
        $this->assertIsString($attr['updated_at']);
    }
}
