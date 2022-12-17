<?php
session_start();
include("connect.php");
$user_email = $_SESSION['user_email'];
$query = mysqli_query($mysqli,"select * from users where user_email = '$user_email'");
$row_user = mysqli_fetch_array($query);
														
$user_id = $row_user['user_id'];
$encoded_user_id = base64_encode($user_id);
$user_name = $row_user['user_name'];
$user_contact = $row_user['user_contact'];
$user_gender = $row_user['user_gender'];
$user_dob = $row_user['user_dob'];
$user_status = $row_user['user_status'];
$user_searchingfor = $row_user['user_searchingfor'];
$user_religion = $row_user['user_religion'];
$user_mothertongue = $row_user['user_mothertongue'];
$user_casteordivision = $row_user['user_casteordivision'];
$user_country = $row_user['user_country'];
$user_state = $row_user['user_state'];
$user_feelings = htmlspecialchars_decode($row_user['user_feeling']);
$user_feeling = str_replace('\r\n', '', $user_feelings);							
$user_image = $row_user['user_image'];
$user_views = $row_user['user_views'];
$presentdate = date("Y");
$time=strtotime($user_dob);

$year=date("Y",$time);
$age = $presentdate-$year;
$life_storys = htmlspecialchars_decode($row_user['life_story']);
$life_story=str_replace('\r\n','',$life_storys);?>


<!-- Change Profile Pic -->
<table id="customers">
	<tr>
		<th><center>Change Profile Pic</center></th>
	</tr>
</table>
										
<form method="post" action="change_profile_pic.php" enctype="multipart/form-data">
							
	<div class="row">
								
		<div class="col-md-12">
			<label>Change Profile Pic</label>
			<div class="form-group">
				<input type="file" name="user_image" id="user_image" required="required" class="form-control" placeholder="Enter Your E-Mail"/>	
			</div>
		</div>
												
		<div class="form-group">
			<center><input type="submit" name="changeprof" id="changeprof" class="btn btn-default" value="Change Profile Pic"></center>
		</div>
											
	</div>
										
</form>
<!-- End Of Change Of Profile Pic -->
										
<!-- Change Password -->
<table id="customers">
	<tr>
		<th><center>Change My Password</center></th>
	</tr>
</table>
										
<form method="post" action="change_password_form.php" enctype="multipart/form-data">
								
	<div class="row">
								
		<div class="col-md-12">
			<label>Old Password</label>
			<div class="form-group">
				<input type="password" name="user_oldpass" id="user_oldpass" required="required" class="form-control" placeholder="Old Password"/>	
			</div>
		</div>
												
		<div class="col-md-12">
			<label>New Password</label>
			<div class="form-group">
				<input type="password" name="user_newpass" id="user_newpass" required="required" class="form-control" placeholder="New Password"/>	
			</div>
		</div>
												
		<div class="col-md-12">
			<label>Repeat New Password</label>
			<div class="form-group">
				<input type="password" name="user_new_reppass" id="user_new_reppass" required="required" class="form-control" placeholder="Repeat New Password"/>	
			</div>
		</div>
												
		<div class="form-group">
			<center><input type="submit" name="changepass" id="changepass" class="btn btn-default" value="Change Password"></center>
		</div>
												
	</div>
											
</form>
<!-- End Of Change Password -->
										
										
						<!-- Edit My Profile -->
									
						<table id="customers">
							<tr>
								<th><center>Edit My Profile</center></th>
							</tr>
						</table>
										
						<form method="post" action="update_edit_profile_form.php" enctype="multipart/form-data">
								
							<div class="row">
						
								<div class="col-md-12">
									<label>Full Name</label>
									<div class="form-group">
										<input type="text" name="user_name" id="user_name" required="required" class="form-control" value="<?php echo $user_name; ?>"/>	
									</div>
								</div>
										
								<div class="col-md-12">
									<label>Mobile Number</label>
									<div class="form-group">
										<input type="number" name="user_contact" id="user_contact" required="required" class="form-control" value="<?php echo $user_contact; ?>"/>
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Gender</label>
									<div class="form-group">
										<select  name="user_gender" id="user_gender" class="form-control" style="background-color:black;">
											<option value="<?php echo $user_gender; ?>"><?php echo $user_gender; ?></option>
											<option value="Male">Male</option>
											<option value="Female">Fe-Male</option>
										</select>
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Date Of Birth</label>
									<div class="form-group">
										<input type="date" name="user_dob" id="user_dob" required="required" class="form-control" value="<?php echo $user_dob; ?>">
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Relationship Status</label>
									<div class="form-group">
										<select  name="user_status" id="user_status" class="form-control" style="background-color:black;">
											<option value="<?php echo $user_status; ?>"><?php echo $user_status; ?></option>
											<option value="Single">Single</option>
											<option value="Committed">Committed</option>
											<option value="Married">Married</option>
										</select>
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Intrested / Searching For</label>
									<div class="form-group">
										<select  name="user_searchingfor" id="user_searchingfor" class="form-control" style="background-color:black;">
											<option value="<?php echo $user_searchingfor; ?>"><?php echo $user_searchingfor; ?></option>
											<option value="Best Friend">Best Friend</option>
											<option value="Boy Friend">Boy Friend</option>
											<option value="Girl Friend">Girl Friend</option>
											<option value="Lover">Lover</option>
											<option value="Life Partner">Life Partner</option>
											<option value="Entrepreneur">Entrepreneur</option>
											<option value="Other Reasons">Other</option>
										</select>
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Select Religion</label>
									<div class="form-group">
										<select name="user_religion" id="user_religion" class="form-control" style="background-color:black;">
											<option value="<?php echo $user_religion; ?>"><?php echo $user_religion; ?></option>
											<option value="Hindu">Hindu</option>
											<option value="Muslim - Shia">Muslim - Shia</option>
											<option value="Muslim - Sunni">Muslim - Sunni</option>
											<option value="Muslim - Others">Muslim - Others</option>
											<option value="Christian - Catholic">Christian - Catholic</option>
											<option value="Christian - Orthodox">Christian - Orthodox</option>
											<option value="Christian - Protestant">Christian - Protestant</option>
											<option value="Christian - Others">Christian - Others</option>
											<option value="Sikh">Sikh</option>
											<option value="Jain - Digambar">Jain - Digambar</option>
											<option value="Jain - Shwetambar">Jain - Shwetambar</option>
											<option value="Jain - Others">Jain - Others</option>
											<option value="Parsi">Parsi</option>
											<option value="Buddhist">Buddhist</option>
											<option value="Inter-Religion">Inter-Religion</option>
											<option value="No Religious Belief">No Religious Belief</option>
										</select>
									</div>
								</div>
												
												<div class="col-md-12">
													<label>Mother Tongue</label>
													<div class="form-group">
														<select  name="user_mothertongue" id="user_mothertongue" class="form-control" style="background-color:black;">
															<option value="<?php echo $user_mothertongue; ?>"><?php echo $user_mothertongue; ?></option>
															<option value="Telugu">Telugu</option>
															<option value="Angika">Angika</option>
															<option value="Arunachali">Arunachali</option>
															<option value="Assamese">Assamese</option>
															<option value="Awadhi">Awadhi</option>
															<option value="Bengali">Bengali</option>
															<option value="Bhojpuri">Bhojpuri</option>
															<option value="Brij">Brij</option>
															<option value="Bihari">Bihari</option>
															<option value="Badaga">Badaga</option>
															<option value="Chatisgarhi">Chatisgarhi</option>
															<option value="Dogri">Dogri</option>
															<option value="English">English</option>
															<option value="French">French</option>
															<option value="Garhwali">Garhwali</option>
															<option value="Garo">Garo</option>
															<option value="Gujarati">Gujarati</option>
															<option value="Haryanvi">Haryanvi</option>
															<option value="Himachali/Pahari">Himachali/Pahari</option>
															<option value="Hindi">Hindi</option>
															<option value="Kanauji">Kanauji</option>
															<option value="Kannada">Kannada</option>
															<option value="Kashmiri">Kashmiri</option>
															<option value="Khandesi">Khandesi</option>
															<option value="Khasi">Khasi</option>
															<option value="Konkani">Konkani</option>
															<option value="Koshali">Koshali</option>
															<option value="Kumoani">Kumoani</option>
															<option value="Kutchi">Kutchi</option>
															<option value="Lepcha">Lepcha</option>
															<option value="Ladacki">Ladacki</option>
															<option value="Magahi">Magahi</option>
															<option value="Maithili">Maithili</option>
															<option value="Malayalam">Malayalam</option>
															<option value="Manipuri">Manipuri</option>
															<option value="Marathi">Marathi</option>
															<option value="Marwari">Marwari</option>
															<option value="Miji">Miji</option>
															<option value="Mizo">Mizo</option>
															<option value="Monpa">Monpa</option>
															<option value="Nicobarese">Nicobarese</option>
															<option value="Nepali">Nepali</option>
															<option value="Oriya">Oriya</option>
															<option value="Punjabi">Punjabi</option>
															<option value="Rajasthani">Rajasthani</option>
															<option value="Sanskrit">Sanskrit</option>
															<option value="Santhali">Santhali</option>
															<option value="Sindhi">Sindhi</option>
															<option value="Sourashtra">Sourashtra</option>
															<option value="Tamil">Tamil</option>
															<option value="Telugu">Telugu</option>
															<option value="Tripuri">Tripuri</option>
															<option value="Tulu">Tulu</option>
															<option value="Urdu">Urdu</option>
														</select>
													</div>
												</div>
												
								<div class="col-md-12">
									<label>Caste / Divison</label>
									<div class="form-group">
										<input type="text" name="user_casteordivision" id="user_casteordivision" required="required" class="form-control" value="<?php echo $user_casteordivision; ?>">
									</div>
								</div>
												
												<div class="col-md-12">
													<label>Select Country</label>
													<div class="form-group">
														<select name="user_country" id="user_country" class="form-control" style="background-color:black;">
															<option value="<?php echo $user_country; ?>"><?php echo $user_country; ?></option>
															<option value="India">India</option>
															<option value="Afghanistan">Afghanistan</option>
															<option value="Albania">Albania</option>
															<option value="Algeria">Algeria</option>
															<option value="American Samoa">American Samoa</option>
															<option value="Andorra">Andorra</option>
															<option value="Angola">Angola</option>
															<option value="Anguilla">Anguilla</option>
															<option value="Antigua & Barbuda">Antigua & Barbuda</option>
															<option value="Antarctica">Antarctica</option>
															<option value="Argentina">Argentina</option>
															<option value="Armenia">Armenia</option>
															<option value="Australia">Australia</option>
															<option value="Aruba">Aruba</option>
															<option value="Azerbaijan">Azerbaijan</option>
															   
															   
															   <option value="Bahamas">Bahamas</option>
															   <option value="Benin">Benin</option>
															   <option value="Algeria">Burundi</option>
															   <option value="Burkina Faso">Burkina Faso</option>
															   <option value="Bulgaria">Bulgaria</option>
															   <option value="Brazil">Brazil</option>
															   <option value="Brunei Darussalam">Brunei Darussalam</option>
															   <option value="Botswana">Botswana</option>
															   <option value="Bosnia">Bosnia</option>
															   <option value="Bolivia">Bolivia</option>
															   <option value="Bhutan">Bhutan</option>
															   <option value="Bermuda">Bermuda</option>
															   <option value="Belize">Belize</option>
															   <option value="Belgium">Belgium</option>
															   <option value="Belarus">Belarusa</option>
															   <option value="Barbados">Barbados</option>
															   <option value="Bangladesh">Bangladesh</option>
															   <option value="Bahrain">Bahrain</option>
															   
															   
															   <option value="Cuba">Cuba</option>
															   <option value="Cyprus">Cyprus</option>
															   <option value="Czech Republic">Czech Republic</option>
															   <option value="Congo, Republic of (Brazzaville)">Congo, Republic of (Brazzaville)</option>
															   <option value="Croatia">Croatia</option>
															   <option value="Ivory Coast">Ivory Coast</option>
															   <option value="Costa Rica">Costa Rica</option>
															   <option value="Cook Islands">Cook Islands</option>
															   <option value="Congo">Congo</option>
															   <option value="Comoros">Comoros</option>
															   <option value="Colombia">Colombia</option>
															   <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
															   <option value="Christmas Island">Christmas Island</option>
															   <option value="China">China</option>
															   <option value="Chile">Chile</option>
															   <option value="Chad">Chad</option>
															   <option value="Central African Republic">Central African Republic</option>
															   <option value="Cayman Islands">Cayman Islands</option>
															   <option value="Cape Verde">Cape Verde</option>
															   <option value="Canada">Canada</option>
															   <option value="Cameroon">Cameroon</option>
															   <option value="Cambodia">Cambodia</option>
															   
															   
															   <option value="Denmark">Denmark</option>
															   <option value="Djibouti">Djibouti</option>
															   <option value="Dominica">Dominica</option>
															   <option value="Dominican Republic">Dominican Republic</option>
															   
															   
															   <option value="East Timor">East Timor</option>
															   <option value="Ecuador">Ecuador</option>
															   <option value="Egypt">Egypt</option>
															   <option value="Ethiopia">Ethiopia</option>
															   <option value="El Salvador">El Salvador</option>
															   <option value="Equatorial Guinea">Equatorial Guinea</option>
															   <option value="Eritrea">Eritrea</option>
															   <option value="Estonia">Estonia</option>
															   
															   
															   <option value="Falkland Islands">Falkland Islands</option>
															   <option value="Faroe Islands">Faroe Islands</option>
															   <option value="Fiji">Fiji</option>
															   <option value="Finland">Finland</option>
															   <option value="French Southern Territories">French Southern Territories</option>
															   <option value="French Polynesia">French Polynesia</option>
															   <option value="France">France</option>
															   <option value="French Guiana">French Guiana</option>
															   
															   
															   <option value="Gabon">Gabon</option>
															   <option value="Gambia">Gambia</option>
															   <option value="Guinea">Guinea</option>
															   <option value="Georgia">Georgia</option>
															   <option value="Guinea-Bissau">Guinea-Bissau</option>
															   <option value="Guyana">Guyana</option>
															   <option value="Guam">Guam</option>
															   <option value="Gibraltar">Gibraltar</option>
															   <option value="Guadeloupe">Guadeloupe</option>
															   <option value="Grenada">Grenada</option>
															   <option value="Germany">Germany</option>
															   <option value="Greenland">Greenland</option>
															   <option value="Guatemala">Guatemala</option>
															   <option value="Greece">Greece</option>
															   <option value="Great Britain">Great Britain</option>
															   <option value="Ghana">Ghana</option>
															   
															   
															   <option value="Haiti">Haiti</option>
															   <option value="Holy See">Holy See</option>
															   <option value="Honduras">Honduras</option>
															   <option value="Hong Kong">Hong Kong</option>
															   <option value="Hungary">Hungary</option>
															   
															   
															   <option value="Iceland">Iceland</option>
															   <option value="India">India</option>
															   <option value="Indonesia">Indonesia</option>
															   <option value="Iran">Iran</option>
															   <option value="Iraq">Iraq</option>
															   <option value="Ireland">Ireland</option>
															   <option value="Israel">Israel</option>
															   <option value="Italy">Italy</option>
															   
															   
															   <option value="Jamaica">Jamaica</option>
															   <option value="Japan">Japan</option>
															   <option value="Jordan">Jordan</option>
															   
															   
															   
															   <option value="Kazakhstan">Kazakhstan</option>
															   <option value="Kenya">Kenya</option>
															   <option value="Kiribati">Kiribati</option>
															   <option value="North Korea">North Korea</option>
															   <option value="South Korea">South Korea</option>
															   <option value="Kosovo">Kosovo</option>
															   <option value="Kyrgyzstan">Kyrgyzstan</option> 		   
															   <option value="Kuwait">Kuwait</option>
															   
															   
															   <option value="Lao">Lao</option>			   
															   <option value="Latvia">Latvia</option>
															   <option value="Lebanon">Lebanon</option>
															   <option value="Liberia">Liberia</option>
															   <option value="Lesotho">Lesotho</option>
															   <option value="Luxembourg">Luxembourg</option>
															   <option value="Lithuania">Lithuania</option>
															   <option value="Liechtenstein">Liechtenstein</option> 		   
															   <option value="Libya">Libya</option>
															   
															   
															   <option value="Myanmar">Myanmar</option>
															   <option value="Montenegro">Montenegro</option>
															   <option value="Monaco">Monaco</option>
															   <option value="Mongolia">Mongolia</option>
															   <option value="Montserrat">Montserrat</option>
															   <option value="Mayotte">Mayotte</option>
															   <option value="Mozambique">Mozambique</option>
															   <option value="Morocco">Morocco</option>
															   <option value="Mauritius">Mauritius</option>
															   <option value="Micronesia">Micronesia</option>
															   <option value="Moldova">Moldova</option>
															   <option value="Mexico">Mexico</option>
															   <option value="Mauritania">Mauritania</option>
															   <option value="Martinique">Martinique</option>
															   <option value="Marshall Islands">Marshall Islands</option>
															   <option value="Malta">Malta</option>
															   <option value="Mali">Mali</option>
															   <option value="Maldives">Maldives</option>
															   <option value="Malaysia">Malaysia</option>
															   <option value="Malawi">Malawi</option>
															   <option value="Madagascar">Madagascar</option>
															   <option value="Macedonia">Macedonia</option>
															   <option value="Macau">Macau</option>
														</select>
													</div>
												</div>
												
								<div class="col-md-12">
									<label>State</label>
									<div class="form-group">
										<input type="text" name="user_state" id="user_state" required="required" class="form-control" value="<?php echo $user_state; ?>">
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Tell Us Something About Yourself In 2 Lines</label>
									<div class="form-group">
										<textarea name="user_feeling" id="user_feeling" required="required" class="form-control" ><?php echo $user_feeling; ?></textarea>
									</div>
								</div>
												
								<div class="col-md-12">
									<label>Share Your Life Bio / Life Story</label>
									<div class="form-group">
										<?php
										if($life_story=="NULL")
										{
											echo "<textarea name='life_story' id='life_story' class='form-control' placeholder='Share Your Life Story.....'/></textarea>";
										}
										else
										{
											echo "<textarea name='life_story' id='life_story' class='form-control' >$life_story</textarea>";
										}
										?>
									</div>										
								</div>
							
							</div>
												
							<div class="form-group">
								<center><input type="submit" name="updateprof" id="updateprof" class="btn btn-default" value="Edit / Update"></center>
							</div>
												
						</div>
								
					</form>
									
					<!-- End Of Edit My Profile -->