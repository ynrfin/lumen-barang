<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BarangTest extends TestCase
{
    use DatabaseMigrations;

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
        $barangs = factory(App\Barang::class, 50)->create();
        $this->get('/', []);

        $this->seeStatusCode('200');

        $this->isJson();

        $this->seeJsonStructure([
            "data" => [
                "items" => [
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
                        ],
                        "links" => [
                            "self"
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
        $barangs = factory(App\Barang::class, 50)->create();
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

            ],
            "links" => [
                "self"
            ]

        ]);

    }

    /**
     * Check output datatype of get /{id} is correct
     */
    public function testResourceDatatype()
    {
        $barangs = factory(App\Barang::class, 50)->create();
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

    /**
     * undocumented function
     *
     * @return void
     */
    public function testShowAllWithRecordDataKeyNotNull()
    {
        $barangs = factory(App\Barang::class, 50)->create();
        $this->json("GET", "/", ['page' => 1], []);

        $response =(array)json_decode($this->response->content());
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('links', $response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertNotEmpty($response["data"]);
    }

    /**
     * undocumented function
     *
     * @return void
     */
    public function testShowAllWithoutRecordDataKeyIsNull()
    {
        //$barangs = factory(App\Barang::class, 50)->create();
        $this->json("GET", "/", ['page' => 1], []);

        $response =(array)json_decode($this->response->content());
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('links', $response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertEmpty($response["data"]->items);
    }

}
