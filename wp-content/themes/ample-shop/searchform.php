<form action="<?php echo esc_url(home_url())?>">
    <div class="input-group">
<input id="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" type="text" placeholder="">
        <button type="submit" class="btn-search" ><i class="fa fa-search"></i></button>
    </div>
</form>

