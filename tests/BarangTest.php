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
        factory(App\Barang::class, 50)->create();
        $this->get('/', []);

        $this->seeStatusCode('200');

        $this->isJson();

        $this->seeJsonStructure([
            "data" => [
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
        factory(App\Barang::class, 50)->create();
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

    public function testResourceDatatype()
    {
        factory(App\Barang::class, 50)->create();
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

    public function testShowAllWithRecordDataKeyNotNull()
    {
        factory(App\Barang::class, 50)->create();
        $this->json("GET", "/", ['page' => 1], []);

        $response =(array)json_decode($this->response->content());
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('links', $response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertNotEmpty($response["data"]);
    }

    public function testShowAllWithoutRecordDataKeyIsNull()
    {
        $this->json("GET", "/", ['page' => 1], []);

        $response =(array)json_decode($this->response->content());
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('links', $response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertEmpty($response["data"]);
    }

    public function testDeleteExistedRecordReturns204NoContent()
    {
        factory(App\Barang::class, 50)->create();
        $this->json("DELETE", "/5");

        $this->assertEmpty($this->response->getOriginalContent());
        $this->assertResponseStatus(204);
    }

    public function testDeleteNonexistentRecordReturns404NotFound(){
        factory(App\Barang::class, 5)->create();
        $this->json("DELETE", "/10");

        $this->assertResponseStatus(404);
        
    }

    public function testCreateNewRecordReturns201AndTheNewResource()
    {
        $this->json("POST", '/', [
			"nama" => "Barang Baru",
			"stok" => 5,
			"harga" => 5000,
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"
        ]);

		$this->assertResponseStatus(201);
		$this->seeInDatabase("barangs", [
			"nama" => "Barang Baru",
			"stok" => 5,
			"harga" => 5000,
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"

        ]);
    }

    public function testCreateWithEmptyParamsReturn422UnprocessableEntity()
    {
        $this->json("POST", '/', [ ]);

        // Unprocessable Entity
		$this->assertResponseStatus(422);
    }
    
    public function testCreateNewRecordWithIncompleteDataReturn422UnprocessableEntity()
    {
        $response = $this->json("POST", '/', [
			"nama" => "Barang Baru",
			"stok" => 5,
			"harga" => 5000,
			"deskripsi" => "barang baru untuk insert via postman",
        ]);
        $this->assertContains('kode field is required', $this->response->content());

		$this->assertResponseStatus(422);
    }

    public function testPatchWithEmptyDataReturns422()
    {
        factory(App\Barang::class, 5)->create();
        $this->json("PATCH", '/3', [ ]);
        // Unprocessable Entity
		$this->assertResponseStatus(422);
    }

    public function testPatchExisingRecordReturnsUpdatedResource()
    {
        factory(App\Barang::class, 5)->create();
        $this->json("PATCH", '/3', [
            'nama' => 'andi'
        ])->seeJson([
            'nama' => 'andi'
        ]);

		$this->seeInDatabase("barangs", [
            "id" => '3',
			"nama" => "andi",
        ]);
		$this->assertResponseStatus(200);
    }

    public function testPatchNonexistentWithVaidatedBodyRecordReturns404()
    {
        factory(App\Barang::class, 5)->create();
        $this->json("PATCH", '/30', [
            'nama' => 'andi'
        ]);
        // Unprocessable Entity
		$this->assertResponseStatus(404);
    }

    public function testPutCompleteParamsDatabaseRecordIsUpdated()
    {
        factory(App\Barang::class, 5)->create();
        $this->json("PUT", '/2', [
			"nama" => "Barang Baru",
			"stok" => 5,
			"harga" => 5000,
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"
        ]);

		$this->assertResponseStatus(200);
		$this->seeInDatabase("barangs", [
			"nama" => "Barang Baru",
			"stok" => 5,
			"harga" => 5000,
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"

        ]);
    }

    public function testPutCompleteParamsResponseContainsInsertedFields()
    {
        factory(App\Barang::class, 5)->create();
        $this->json("PUT", '/2', [
			"nama" => "Barang Baru",
			"stok" => 5,
			"harga" => 5000,
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"
        ])->seeJson([
			"nama" => "Barang Baru",
			"stok" => 5,
			"harga" => 5000,
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"
        ]);

		$this->assertResponseStatus(200);
    }

    public function testPutIncompleteParamsResponse422UnprocessableEntity()
    {
        factory(App\Barang::class, 5)->create();
        $this->json("PUT", '/2', [
			"nama" => "Barang Baru",
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"
        ])->assertResponseStatus(422);
    }

    public function testPutNonexistentRecordWithIncompleteBodyReturns422()
    {
        factory(App\Barang::class, 5)->create();
        $this->json("PUT", '/20', [
			"nama" => "Barang Baru",
			"deskripsi" => "barang baru untuk insert via postman",
			"kode" => "SKU-4421"
        ])->assertResponseStatus(422);
    }
}
