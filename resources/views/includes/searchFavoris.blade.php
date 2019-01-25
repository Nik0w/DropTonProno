<div class="col-12 col-md-8 offset-md-2" style="padding:0;">
  <form action="{{url()->current()}}/search">
    {{csrf_field()}}
       <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="searchAddon">
            <i class="fas fa-search"></i>
          </span>
        </div>
        <input id="searchFriends" type="text" class="form-control" name="searchFriends" aria-describedby="search friends" placeholder="Je cherche mes potes" autocomplete="off">
      </div>
      <div id="searchFriendsResults">
        <i id="closeSearchArea" class="far fa-times-circle"></i>
        <div id="results"></div>
      </div>
  </form>
</div>