<?php
// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'author_name' => 'required|max:100',
            'author_email' => 'required|email|max:100',
            'content' => 'required|max:1000',
        ]);
        
        $validated['post_id'] = $post->id;
        $validated['is_approved'] = false; // Comentários precisam de aprovação
        
        Comment::create($validated);
        
        return redirect()->route('posts.show', $post->slug)
            ->with('success', 'Comentário enviado para aprovação!');
    }
    
    // Admin: Gerenciar comentários
    public function adminIndex()
    {
        $comments = Comment::with('post')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.comments.index', compact('comments'));
    }
    
    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        
        return redirect()->route('admin.comments.index')
            ->with('success', 'Comentário aprovado com sucesso!');
    }
    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        
        return redirect()->route('admin.comments.index')
            ->with('success', 'Comentário excluído com sucesso!');
    }
}