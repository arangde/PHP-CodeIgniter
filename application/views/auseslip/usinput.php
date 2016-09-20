<?php
    global $g_day_of_week;
?>
<div class="modal" id="modal_useslip_input_result_form">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content">
			<div class="modal-header">
				<div class="dark-bar">
			        <div class="row">
			        	<div class="col-md-12">
							<h4><?php echo isset($this->session->userdata['contract_data']['c_username'])?$this->session->userdata['contract_data']['c_username']:"";?>の <?php echo $useslip_year;?>年 <?php echo $useslip_month;?>月 "居宅支援Ⅰ１" 実績を入力する</h4>
							<a href="#" class="btn btn-success btn-close" id="btn_useslip_input_result_close">閉じる</a>
			           	</div>
			        </div>
			    </div>
			</div>
			<div class="modal-body">
	            <form class="horizontal-form" name="frm_useslip_input_modal" id="frm_useslip_input_modal" method="post">
	            	<input type="hidden" name="hdn_modal_useslip_year" id="hdn_modal_useslip_year" value="<?php echo $useslip_year;?>" />
		            <input type="hidden" name="hdn_modal_useslip_month" id="hdn_modal_useslip_month" value="<?php echo $useslip_month;?>">
		            <input type="hidden" name="hdn_modal_us_id" id="hdn_modal_us_id" value="">
		           	<div class="row">
			            <div class="col-md-12">
		            	<table class="table-green table-list table-scrollable">
			                <tbody>
			                	<tr>
				                    <th class="text-center" rowspan="2"></th>
				                    <th class="text-center" colspan="<?php echo $last_day;?>"><?php echo $useslip_year;?>年<?php echo $useslip_month;?>月</th>
				                </tr>
				                <tr>
				                	 <?php for($i=0; $i<$last_day; $i++) { ?>
		                                <th class="th-small"><?php echo $i + 1; ?>(<?php echo $g_day_of_week[jddayofweek (cal_to_jd(CAL_GREGORIAN, $useslip_month,$i+1, $useslip_year), 0)];?>)</th>
		                            <?php } ?>
	                            </tr>
	                            <tr id="ur_schedule_panel">	                				
	                            </tr>
			                    <tr id="ur_result_panel">
			               		</tr>
	                        </tbody>
	                    </table>
	                    </div>
					</div>
					<div class="form-group">
		                <div class="orange-row">
		                    <div class="row">
		                        <div class="col-md-8">
		                            「保存する」ボタンを押して、内容を保存する。
		                        </div>
		                        <div class="col-md-4 text-right">
		                            <input type="button" class="btn btn-success" name="btn_useslip_create_modal_save" id="btn_useslip_create_modal_save" value="保存する" />
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </form>
			</div>
		</div>
	</div>
</div>