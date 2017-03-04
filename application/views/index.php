
<?php $this->load->view('sidebar') ?>
		<div class="col-sm-6 col-md-7 main">
			<form role="form">
				<div class="form-group">
					<textarea class="form-control" name="post-body" id="post-body" placeholder="What's today's BC?" onkeyup="textAreaAdjust(this)"></textarea>
				</div>
				<button type="button" class="btn btn-info pull-right" id="settargets" data-target="#usertargetmodal" data-toggle="modal">Announce</button>
				
			</form>
			<br><br>
			<div class="post-area">
				<?php echo $main_content; ?>
				
			</div>
		</div>
		
	</div><!-- /.row -->
</div><!-- /.container-fluid -->

<div id="usertargetmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set your target users</h4>
      </div>
      <div class="modal-body">
        <p>
        	<form>
        		<div class="form-group">
        			<label>Set gender for your target:</label>
        			<br>
        			<label><input type="checkbox" name="gender" class="checkbox-inline form-control gender" value="male">Male</label>
        			<label><input type="checkbox" name="gender" class="checkbox-inline form-control gender" value="female">Female</label>
        		</div>
        		<div class="form-group">
        			<label>Interests</label>
        			<?php if (isset($interests) AND !empty($interests)): ?>
        				<?php foreach($interests as $interest): ?>
        					<label><input type="checkbox" name="interests" class="checkbox-inline interests_box" value="<?php echo $interest->name ?>"><?php echo $interest->name ?></label>
        				<?php endforeach; ?>
        			<?php else: ?>

        			<?php endif; ?>
        			
        			
        		</div>
        		<div class="form-group">
        			<select name="agebracket" class="form-control" multiple>
        				<option disabled="">Age Range</option>
        				<option value="18 and 29">Between 18 and 29</option>
        				<option value="30 and 40">Between 30 and 40</option>
        				<option value="41 and 60">Between 41 and 60</option>
        				<option value="61 and 70">Between 61 and 70</option>
        			</select>
        		</div>
                <div class="form-group">
                    <div class="col-xs-6">
                        <select name="country" class="form-control" id="countries-select">
                            <?php $countries = getCountries() ?>
                            <option value="">Country</option>
                            <?php if (!empty($countries)): ?>
                                <?php foreach ($countries as $country): ?>
                                    <option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-xs-6">
                        <select name="state" class="form-control" id="states-select">
                            
                        </select>
                    </div>
                </div>
        	</form>
        	<div class="users-count-area">
        		
        	</div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-info pull-right" id="submit-post-button"  data-target="#usertargetmodal" data-toggle="modal"><i class="fa fa-bullhorn"></i> Announce</button>
      </div>
    </div>

  </div>
</div>