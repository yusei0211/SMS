<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <!--<a class="navbar-brand" href="#">ブログ</a>-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="{{ route('owner.blogs') }}">投稿一覧 <span class="sr-only"></span></a>
      <a class="nav-item nav-link" href="{{ route('owner.users') }}">利用者一覧</a>
      <a class="nav-item nav-link" href="{{ route('owner.dashboard') }}">Myページ</a>
    </div>
  </div>
</nav>