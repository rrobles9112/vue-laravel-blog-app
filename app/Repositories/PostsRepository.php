<?php

namespace App\Repositories;

use App\Models\Posts;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PostsRepository
 * @package App\Repositories
 * @version April 28, 2018, 12:01 am UTC
 *
 * @method Posts findWithoutFail($id, $columns = ['*'])
 * @method Posts find($id, $columns = ['*'])
 * @method Posts first($columns = ['*'])
*/
class PostsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'content',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Posts::class;
    }
}
