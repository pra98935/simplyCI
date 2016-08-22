<div class="col-sm-8">
	<div class="admin_leftbar owner_admin">
	<h3 class="admin_heading">Calendar Settings</h3>
	<!----------------------------->
	<!-- Modal -->
  <div class="modal fade calendor_model" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Your Editing <span class="dateShow">10 MAY 2016</span></h4>
        </div>
        <div class="modal-body">
        <form action="#" method="post">
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="delivery" class="delivery"> Back for delivery
			    </label>
			  </div>
			  <div class="checkbox">
			    <label>
			      <input type="checkbox" name="recurring" class="recurring"> Recurring
			    </label>
			  </div>
			  <div class="form-group">
			    <label for="">Set State</label>
			     <select name="state"  class="form-control state">
					 
					<option value="">Please select</option>
					 <?php $count=0; foreach($locations  as $location){?>
                      <?php if($count==0) { ?> 
                      <option selected value="<?php echo $location['state']; ?>"><?php echo $location['state']; ?></option>
									<?php 
									$count++; 
									}
									} ?>  
					 
					 </select>
			  </div>
			  <div class="form-group">
			    <label for="">Set County</label>
			     <select name="county" class="form-control county">
			      <option  value="">Please select</option>
			      <?php foreach($locations  as $location){?>
					  <option value="<?php echo $location['county']; ?>"><?php echo $location['county']; ?></option>
									<?php } ?>  
			     </select>
			  </div>
			  <div class="form-group">
			    <label style="display: block" for="">Set Code</label>
			    
			    <div class="squaredThree color1">
			      <input type="radio" value="#ff7900" id="squaredThree" name="check"  />
			      <label for="squaredThree"></label>
			    </div>
			    <div class="squaredThree color2">
			      <input type="radio" value="#b6d6a5" id="squaredThree1" name="check"  />
			      <label  style="background: #b6d6a5;" for="squaredThree1"></label>
			    </div>
			    <div class="squaredThree color3">
			      <input type="radio" value="#f4d36c" id="squaredThree2" name="check" checked />
			      <label  style="background: #f4d36c;" for="squaredThree2"></label>
			    </div>
			    <div class="squaredThree color4" >
			      <input type="radio" value="#9cc3ee"  id="squaredThree3" class="color" name="check" />
			      <label style="background: #9cc3ee;" for="squaredThree3"></label>
			    </div>
			     
			  </div>
			  <div class="form-group btn_save">
			    <button type="button" name="saveEvent" class="saveEvent" >Save </button>
			     </div>
			  <div class="savedata success"></div>
			  </form>


        </div>
             </div>
      
    </div>
  </div>


	<!----------------------------->
	<div class="success">
	<?php echo $this->session->flashdata('message');  ?> </div>
		<div class="calendar_bar">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Calendar</a></li>
				<li><a data-toggle="tab" href="#menu1">Locations</a></li>
				<li><a data-toggle="tab" href="#menu2">Add New Location</a></li>
			</ul>
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<div class="admin_calender">
						<div id="my-calendar5"></div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group calendar_save">
	<!-------------added by trilok for calender------------>
	<script>
	$(document).ready(function() {

	json_events = '<?php echo  json_encode($events); ?>';
	
	$('#calendar').fullCalendar({  
		dayClick: function(date, jsEvent, view) {
		
		// change the day's background color just for fun
       // $(this).css('background-color', 'red');
        
        insertEvent(date);

    },
			dayRender: function (date, cell) {
			
			$.each( JSON.parse(json_events), function( key, value ) {
					
					if (date.isSame(value.date)) {
					   cell.css("background-color",value.color);
					}
			   
			})	
           
        	},
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			}
	});
	

	//function for adding event on database 
	function insertEvent(date){
	
		$('.dateShow').html(date.format('MMMM-DD-YYYY'));
		$('#myModal').modal('show');
		$.ajax({
			method:"POST",
			url:"<?php echo base_url().'/admin/getEventByDate'; ?>",
			data:{'date': date.format('MMMM-DD-YYYY')},
			dataType:"json",
			success:function(res){
			
			$('.county').val(res.county);
			$('.state').val(res.state);
			
			$("input[name=check]").each(function () {
			if($(this).val()== res.color){
			$(this).prop("checked",'checked');
			}
			
			});
			}
		});
		
		
	
	}
	

	$('.saveEvent').on('click',function(){ 
		
		
		
		var state = $('.state').val();
		
		if(!state){
		alert('Please select state.');
		return false; 
		} 
		var county = $('.county').val();
		
		if(!county){
		alert('Please select county.');
		return false; 
		}
		var color = $("input[name=check]:checked").val();
		var recurring = $('.recurring').val();
		var dateShow = $('.dateShow').html();
		var delivery = $('.delivery').is(":checked");
		
		if(delivery){
			
		var color='red'; 
		
		}
		
		data ={'state': state,'county': county,'delivery': delivery,'recurring': recurring,'date': dateShow,'color': color };
		
		//$('#calendar').fullCalendar( 'refresh' );
		$.ajax({
			method:"POST",
			url:"<?php echo base_url().'/admin/addEvent'; ?>",
			data:data,
			dataType:"json",
			success:function(res){
			
			$('.savedata').html(res.msg);
			
			setTimeout(function(){ location.reload(); }, 1000);
			
			}
		});
	});
	});

</script>
			<div id='wrap'>
			<div id='calendar'></div>
			<div style='clear:both'></div>
			</div>
				</div>
					</div>
					</div>
				</div>

				<div id="menu1" class="tab-pane fade">
					<div class="row">
						<form role="form" method="post" action="#" id="current-state">
							
							<div class="col-sm-12">
								<div class="zipcode_bar">
						 <table id="locations" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>zipcode</th>
                                            <th>city</th>
                                            <th>state</th>
                                            <th>county</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($locations  as $location){?>
                                        <tr>
                                            <td>
											<?php echo $location['zipcode']; ?>
                                            </td>
                                            <td>
											<?php echo $location['city']; ?>
                                            </td>
                                            <td>
											<?php echo $location['state']; ?>
                                            </td>
                                            <td>
											<?php echo $location['county']; ?>
                                            </td>
                                        </tr>
									<?php } ?>                             
                                    </tbody>
                                </table>		
								</div>
							</div>
						</form>
					</div>
				</div>
				<div id="menu2" class="tab-pane fade">
					<div class="row">
						<form role="form" id="add-state" method="post">
							<div class="col-sm-3">
								<div class="form-group">
									<label for="email">Zipcode:</label>
									<input type="text" id="" class="form-control" placeholder="zipcode" name="zipcode" required>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label for="email">City:</label>
									<input type="text" id="" class="form-control" placeholder="City" name="city" required>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label for="email">State:</label>
									<input type="text" id="" class="form-control" placeholder="State" name="state"  readonly value="New Jersey" required>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label for="email">County:</label>
									
							<select name="county" id="input-county" class="form-control" required>
                          <option value="">--Select--</option>
                          <option value="essex_counties">Essex Counties</option>
                          <option value="hunterdon">Hunterdon</option>
                          <option value="mercer">Mercer</option>
                          <option value="middlesex_counties">Middlesex Counties</option>
                          <option value="morris">Morris</option>
                          <option value="somerset">Somerset</option>
                          <option value="union">Union</option>
                          <option value="warren">Warren</option>
                        </select>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group">
									<button class="btn btn-contact" type="submit" name="add_location" value="add_location">ADD Location</button>
								</div>
							</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script>

$(document).ready(function() {
    //$('#locations').DataTable();
    // Setup - add a text input to each footer cell
    $('#locations thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#locations').DataTable({ 
        "ordering": false,
        "info":     false,
        
         "showNEntries" : false,
          "bLengthChange": false,
        });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.header() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );
</script>



