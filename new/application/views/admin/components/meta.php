<div class="control-group">
        <label class="control-label" for="focusedInput">Meta Ключевые слова<br /> (keywords)</label>
        <div class="controls">
            <textarea name="keywords" style="width: 255px; height: 180px;"><?=set_value('keywords', $post->keywords)?></textarea>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label" for="focusedInput">Meta Описание<br /> (description)</label>
        <div class="controls">
            <textarea name="description" style="width: 255px; height: 180px;"><?=set_value('description', $post->description)?></textarea>
        </div>
    </div> 