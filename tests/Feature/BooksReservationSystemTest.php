<?php


namespace Tests\Feature;
use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksReservationSystemTest extends TestCase
{
    use WithFaker,RefreshDatabase;
    /** @test */
 
    
     public function a_book_can_be_added_to_the_library()
     {
         $this->withoutExceptionHandling();
         $data = [
             'title'=>'title',
             'author'=>'author'
         ];
         $response=$this->post('/books',$data);
         $this->assertCount(1,Book::all());
     }

     /** @test */
     public function a_title_is_required(){
        $this->withoutExceptionHandling();
        $data = [
            'title'=>'',
            'author'=>'author'
        ];
        $response=$this->post('/books',$data);
        $response->assertSessionHasErrors('title');
     }

     /** @test */
     public function a_author_is_required(){
        //  $this->withoutExceptionHandling();
        $data = [
            'title'=>'title',
            'author'=>''
        ];
        $response=$this->post('/books',$data);
        $response->assertSessionHasErrors('author');

     }

     /** @test  */
     public function a_book_can_be_updated(){
        $this->withoutExceptionHandling();
        $data = [
            'title'=>'old-title',
            'author'=>'old-author'
        ];
        $this->post('/books',$data);
        $book=Book::first();
         $updated_data = [
            'title'=>'New-title',
            'author'=>'New-author'
        ];
        $this->patch('/books/'.$book->id,$updated_data);
        $this->assertEquals('New-ss',Book::first()->title);
     }

}
