import React from 'react';

const PostIndex = ({ posts }) => {
    return (
        <div className="container mx-auto p-4"> {/* Tailwindのコンテナを追加 */}
            <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                Blog Name
            </h2>
            <div className="user-info mb-4"> {/* マージンを追加 */}
                <span>Welcome, User</span>
            </div>

            <a href='/posts/create' className="text-blue-500 hover:underline mb-4 block">Create New Post</a>

            <div className='posts'>
                {posts.length > 0 ? (
                    posts.map((post) => (
                        <div className='post border-b pb-4 mb-4' key={post.id}> {/* 境界線と余白を追加 */}
                            <h2 className='title font-bold text-lg'>
                                <a href={`/posts/${post.id}`} className="text-blue-600 hover:underline">{post.title}</a>
                            </h2>
                            <a href={`/categories/${post.category.id}`} className="text-gray-500">{post.category.name}</a>
                            <p className='body text-gray-700'>{post.body}</p>
                            <form action={`/posts/${post.id}`} id={`form_${post.id}`} method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="button" onClick={() => deletePost(post.id)} className="text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>
                    ))
                ) : (
                    <p>No posts available.</p>
                )}
            </div>

            <div className='paginate'>
                {posts.links()} 
            </div>
        </div>
    );
};

export default PostIndex;
