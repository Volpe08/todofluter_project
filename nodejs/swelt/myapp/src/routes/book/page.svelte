

<h1>Books</h1>
<TinyDB bind:books={book}></TinyDB>

<ul>
    {#each books as book}
    <li><img src="data:{book.img.content_type};base64,{book.img.data}"></li>
    {/each}
</ul>