<div class="form-group">
    <label for="category" class="col-sm-2 control-label">分类</label>
    <div class="col-sm-10">
        <select class="form-control" name="category">
              <option value="">点击选择分类</option>
          @foreach($categories as $category)
              <option value="{{ $category->id }}" <?php if(isset($article)){if($article->category_id == $category->id) echo "selected";} ?>>{{ $category->name }}</option>
          @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label">标题</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="title" value="{{ $article->title or '' }}">
    </div>
</div>
<div class="form-group">
    <label for="cover" class="col-sm-2 control-label">封面图片</label>
    <div class="col-sm-10">
        @if(isset($article))
            <img src="{{ $article->cover }}" alt="" style="height:100px">
        @endif
        <input type="file" class="form-control" id="cover" name="cover">
        <p class="help-block">最佳分辨率 480*300</p>
    </div>
</div>
<div class="form-group">
    <label for="intro" class="col-sm-2 control-label">介绍</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="intro" value="{{ $article->intro or ''}}">
    </div>
</div>
