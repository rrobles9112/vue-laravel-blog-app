<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Customer
 *
 */
	class Customer extends \Eloquent {}
}

namespace App{
/**
 * App\Posts
 *
 * @property-read \App\Posts $user
 */
	class Posts extends \Eloquent {}
}

namespace App{
/**
 * App\Taggables
 *
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $taggables
 */
	class Taggables extends \Eloquent {}
}

namespace App{
/**
 * App\Tags
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Taggables[] $comments
 */
	class Tags extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Posts[] $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Taggables[] $taggables
 */
	class User extends \Eloquent {}
}

