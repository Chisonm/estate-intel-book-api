<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Resources\CreateBookResource;
use App\Models\Book;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BooksController extends Controller
{

    // inject ApiBaseController with constructor
    public $apiBaseController;
    public function __construct(ApiBaseController $apiBaseController)
    {
        $this->apiBaseController = $apiBaseController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            // url
            $apiURL = 'https://www.anapioficeandfire.com/api/books';
            // guzzle client
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $apiURL);
            

            $statusCode = $response->getStatusCode();
            $responseBody = json_decode($response->getBody(), true);
            // if responseBody is true return success status
            // dd($responseBody);
            if ($responseBody) {
                // fromat response with BookResource
                $response = BookResource::collection($responseBody);
                // return response
                // dd($response);
                return $this->apiBaseController->successResponse($response, 'Books are successfully fetched', $statusCode);
            } else {
                return $this->apiBaseController->errorResponse([], 'Books are not fetched', $statusCode);
            }
        } catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        // try catch
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string|max:255",
                "isbn" => "required|string|max:255",
                "authors" => "required|string|max:255",
                "publisher" => "required|string|max:255",
                "country" => "required|string|max:255",
                "number_of_pages" => "required|integer",
                "released_date" => "required|date",
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            // validated data
            $data = $validator->validated();  
            // convert authors to array
            $authors = explode(',', $data['authors']);
            $data['authors'] = $authors;
            // convert date format
            $data["released_date"] = date("Y-m-d", strtotime($data["released_date"]));
           
            // create book
            $book = Book::create($data);
            // if book is created return success status
            if ($book) {
                // return response
                return $this->apiBaseController->successResponse(["book" => new CreateBookResource($book)], 'Book is successfully created', Response::HTTP_CREATED);
            } else {
                return $this->apiBaseController->errorResponse([], 'Book is not created', Response::HTTP_BAD_REQUEST);
            }
        } catch (ValidationException $e) {
            $message = "The given data was invalid.";
            // reurn response
            return response()->json(["message" => $message], Response::HTTP_UNPROCESSABLE_ENTITY, $e->errors());
        }catch (Exception $e) {
            return response()->json(["message" => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
