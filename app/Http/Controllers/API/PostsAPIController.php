<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostsAPIRequest;
use App\Http\Requests\API\UpdatePostsAPIRequest;
use App\Models\Posts;
use App\Repositories\PostsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;



/**
 * Class PostsController
 * @package App\Http\Controllers\API
 */

class PostsAPIController extends AppBaseController
{
    /** @var  PostsRepository */
    private $postsRepository;

    public function __construct(PostsRepository $postsRepo)
    {
        $this->postsRepository = $postsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/posts",
     *      summary="Get a listing of the Posts.",
     *      tags={"Posts"},
     *      description="Get all Posts",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Posts")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->postsRepository->pushCriteria(new RequestCriteria($request));
        $this->postsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $posts = $this->postsRepository->all();

        return $this->sendResponse($posts->toArray(), 'Posts retrieved successfully');
    }

    /**
     * @param CreatePostsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/posts",
     *      summary="Store a newly created Posts in storage",
     *      tags={"Posts"},
     *      description="Store Posts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Posts that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Posts")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Posts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePostsAPIRequest $request)
    {
        $input = $request->all();
        $user = $this->getAuthenticatedUser();

        $input['users_id']=$user->getData()->user->id;
        // print_r($input);
        $posts = $this->postsRepository->create($input);

        return $this->sendResponse($posts->toArray(), 'Posts saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/posts/{id}",
     *      summary="Display the specified Posts",
     *      tags={"Posts"},
     *      description="Get Posts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Posts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Posts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Posts $posts */
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            return $this->sendError('Posts not found');
        }

        return $this->sendResponse($posts->toArray(), 'Posts retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePostsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/posts/{id}",
     *      summary="Update the specified Posts in storage",
     *      tags={"Posts"},
     *      description="Update Posts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Posts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Posts that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Posts")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Posts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePostsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Posts $posts */
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            return $this->sendError('Posts not found');
        }

        $posts = $this->postsRepository->update($input, $id);

        return $this->sendResponse($posts->toArray(), 'Posts updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/posts/{id}",
     *      summary="Remove the specified Posts from storage",
     *      tags={"Posts"},
     *      description="Delete Posts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Posts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Posts $posts */
        $posts = $this->postsRepository->findWithoutFail($id);

        if (empty($posts)) {
            return $this->sendError('Posts not found');
        }

        $posts->delete();

        return $this->sendResponse($id, 'Posts deleted successfully');
    }

    // somewhere in your controller
    public function getAuthenticatedUser()
    {
        try {

            if (! $user = \Tymon\JWTAuth\Facades\JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException  $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json(compact('user'));
    }

}
