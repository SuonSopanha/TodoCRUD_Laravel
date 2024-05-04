<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Todo API",
 *      description="Todo API",
 *      @OA\Contact(
 *          email="khoa@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */
/**
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Todo API server"
 * )
 */

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 * )
 */

/**
 * @OA\Get(
 *      path="/",
 *      summary="Show the application welcome screen (default route)",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation"
 *       )
 * )
 */
abstract class Controller
{
    //
}
