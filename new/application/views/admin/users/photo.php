<h2>Photo approval</h2>
<?=($this->session->flashdata('message'))?'<div class="alert alert-success">'.$this->session->flashdata('message').'</div>':''?>
<table class="table table-striped table-bordered">
  <thead>
	<tr>
	  <th>Photo</th>
	  <th><?=lang('name')?></th>
	  <th><?=lang('email')?></th>
	  <th width="220"><?=lang('actions')?></th>
	</tr>
  </thead>
  <tbody>
	<? foreach($users as $user): ?>
		<tr>
		  <td><a class="fancybox-thumbs" data-fancybox-group="thumb" href="<?=base_url()?>uploads/profile/<?=$user->picture?>"><img src="<?=base_url('thumb/view/w/50/h/50/src/uploads/profile/'.$user->picture)?>"></a></td>
		  <td><?=$user->first_name.' '.$user->last_name?></td>
		  <td><?=$user->email?></td>
		  <td>
			<a href="<?=site_url('admin/users/approve/'.$user->user_id)?>"><i class="icon-edit"></i>Approve</a> | 
			<a href="<?=site_url('admin/users/disapprove/'.$user->user_id)?>"><i class="icon-edit"></i>Disapprove</a>
		  </td>
		</tr>
	<? endforeach; ?>
  </tbody>
</table>
<?=form_close()?>
<script type="text/javascript">
	$(document).ready(function() 
{
             /*
             *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
             */

            $('.fancybox-thumbs').fancybox({
                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : true,
                arrows    : false,
                nextClick : false,

                helpers : {
                    thumbs : {
                        width  : 50,
                        height : 50
                    }
                }
            });
        
});
</script>