<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_thats_check_the_book_index_page_to_run(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/books');
        $response->assertStatus(200);
    }

    public function test_thats_add_a_book_to_the_database()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/books', [
            'title' => 'The world',
            'author' => 'Dalim',
        ]);
        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    public function test_title_is_required_when_add_a_book()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'Dalim',
        ]);
        $response->assertSessionHasErrors(['title']);
    }
    public function test_author_is_required_when_add_a_book()
    {
        $response = $this->post('/books', [
            'title' => 'abc',
            'author' => '',
        ]);
        $response->assertSessionHasErrors(['author']);
    }
    public function test_book_is_updated()
    {
        $this->withoutExceptionHandling();
        $this->post('/books', [
            'title' => 'abcd',
            'author' => 'datlim',
        ]);

        $response = $this->patch('/books/' . Book::first()->id, [
            'title' => 'new title',
            'author' => 'new author',
        ]);

        $this->assertEquals('new title', Book::first()->title);
        $this->assertEquals('new author', Book::first()->author);
    }
    public function test_title_is_required_when_update_a_book()
    {
        $response = $this->post('/books', [
            'title' => '',
            'author' => 'test',
        ]);
        $response->assertSessionHasErrors(['title']);
    }
    public function test_author_is_required_when_update_a_book()
    {
        $response = $this->post('/books', [
            'title' => 'abc',
            'author' => '',
        ]);
        $response->assertSessionHasErrors(['author']);
    }
}
