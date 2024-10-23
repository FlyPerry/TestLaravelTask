<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(title="Add comments", version="1.0")
 */
class CommentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/comments",
     *     summary="Add a comment to a post or video",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"body", "commentable_id", "commentable_type"},
     *             @OA\Property(property="body", type="string"),
     *             @OA\Property(property="commentable_id", type="integer"),
     *             @OA\Property(property="commentable_type", type="string", enum={"post", "video"}),
     *         )
     *     ),
     *     @OA\Response(response=201, description="Comment added successfully"),
     *     @OA\Response(response=404, description="Invalid commentable type or resource not found"),
     *     @OA\Response(response=422, description="Validation error"),
     * )
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        // Получаем аутентифицированного пользователя
        $userId = Auth::id(); // Используйте аутентифицированного пользователя

        // Проверяем, существует ли commentable модель
        $commentable = $this->getCommentableModel($request->input('commentable_type'), $request->input('commentable_id'));

        // Создаем комментарий, добавляя user_id
        $comment = Comment::create([
            'body' => $request->input('body'),
            'commentable_id' => $commentable->id,
            'commentable_type' => $request->input('commentable_type'),
            'user_id' => $userId, // Подставляем user_id
        ]);

        return response()->json($comment, 201);
    }

    /**
     * @param string $type
     * @param int $id
     * @return mixed
     *
     * Получение комментария
     */
    private function getCommentableModel($type, $id)
    {
        switch ($type) {
            case 'post':
                return Post::findOrFail($id);
            case 'video':
                return Video::findOrFail($id);
            default:
                abort(404, 'Invalid commentable type');
        }
    }
}
