<?php $DatabaseCoCount = new DatabaseConn(); ?>
<aside class="main-sidebar">
   <section class="sidebar">
      <ul class="sidebar-menu">
         <li id="dashy">
            <a href="dashboard">
            	<i class="fa fa-dashboard"></i><span>My Dashboard</span>
            </a>
         </li>
         <li id="first">
            <a href="first_form_data">
            	<i class="fa fa-user"></i><span>First Form Data</span>
            </a>
         </li>
         <li class="treeview" id="site-settings">
            <a href="javascript:;">
            <i class="fa fa-cogs"></i>
            <span>Site Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="sitelogo">
                  <a href="SiteLogo" title="Update Favicon & Logo" >
                  <i class="fa fa-square"></i>Update Favicon & Logo
                  </a>
               </li>
			   <li id="homepagebanner">
                  <a href="SiteHomepageBanner" title="Update Home Page Banner" >
                  <i class="fa fa-square"></i>Update Home Page Banner
                  </a>
               </li>
			   <li id="photowatermark">
                  <a href="SitePhotoWatermark" title="Update Photo Watermark" >
                  <i class="fa fa-square"></i>Update Watermark
                  </a>
               </li>
			   <li id="sitefield">
                  <a href="SiteFieldSetting" title="Enable / Disable Field" >
                  <i class="fa fa-square"></i>Enable / Disable Fields
                  </a>
               </li>
               <li id="sitechangeid">
                  <a href="SiteChangeId">
                  <i class="fa fa-square"></i>Update Profile Id
                  </a>
               </li>
               <li id="siteupdateemail">
                  <a href="SiteUpdateEmail">
                  <i class="fa fa-square"></i>Update Email Settings
                  </a>
               </li>
               <li id="sitebasicsetting">
                  <a href="SiteBasicSetting">
                  <i class="fa fa-square"></i>Update Basic Site Setting
                  </a>
               </li>
               <li id="siteanalyticscode">
                  <a href="SiteAnalyticsCode">
                  <i class="fa fa-square"></i>Update/Add Analytics Code
                  </a>
               </li>
               <li id="sitepassword">
                  <a href="SitePassword">
                  <i class="fa fa-square"></i>Change Password
                  </a>
               </li>
               <li id="sitesocialicon">
                  <a href="SiteSocialIcon">
                  <i class="fa fa-square"></i>Update Social Media Link
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="add-new">
            <a href="javascript:;">
            <i class="fa fa-plus"></i>
            <span>Add New Details</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="religion">
                  <a href="updateWebSiteReligion">
                  <i class="fa fa-square"></i>Add Religion
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(religion_id) from religion", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="caste">
                  <a href="updateWebSiteCaste">
                  <i class="fa fa-square"></i>Add Caste
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(caste_id) from caste", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="caste">
                  <a href="updateWebSiteSubCaste">
                  <i class="fa fa-square"></i>Add Sub Caste
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(sub_caste_id) from sub_caste", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="country">
                  <a href="updateWebSiteCountry">
                  <i class="fa fa-square"></i>Add Country
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(COUNTRY_ID) from country", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="state">
                  <a href="updateWebSiteState">
                  <i class="fa fa-square"></i>Add State
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(STATE_ID) from state_view", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="city">
                  <a href="updateWebSiteCity">
                  <i class="fa fa-square"></i>Add City
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(CITY_ID) from city", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="occup">
                  <a href="updateWebSiteOccupation">
                  <i class="fa fa-square"></i>Add Occupation
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(ocp_id) from occupation", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="edu">
                  <a href="updateWebSiteEducation">
                  <i class="fa fa-square"></i>Add Education
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(edu_id) from education_detail", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="mtongue">
                  <a href="updateWebSiteMotherTongue">
                  <i class="fa fa-square"></i>Add Mother Tongue
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(mtongue_id) from mothertongue", $DatabaseCoCount);?></span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="members">
            <a href="javascript:;">
            <i class="fa fa-users"></i>
            <span>Members</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="all-members">
                  <a href="members">
                  <i class="fa fa-square"></i>All Members
                  </a> 
               </li>
               <li id="active-to-paid">
                  <a href="memberActiveToPaid">
                  <i class="fa fa-square"></i>Active To Paid
                  </a>
               </li>
               <li id="renew-member">
                  <a href="memberRenew">
                  <i class="fa fa-square"></i>Renew Membership
                  </a>
               </li>
               <li id="edit-plan-member">
                  <a href="edit_plan">
                  <i class="fa fa-square"></i>Change Membership Plan
                  </a>
               </li>
			   <li id="paid-to-spotlight">
                  <a href="memberPaidToSpotlight">
                  <i class="fa fa-square"></i>Featured Profile
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="match">
            <a href="javascript:;">
            <i class="fa fa-ruble"></i>
            <span>Match Making</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="making">
                  <a href="new-matchmacking">
                  	<i class="fa fa-sort"></i> <span>Profile Match Making</span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="mem_ship">
            <a href="javascript:;">
            <i class="fa fa-ruble"></i>
            <span>Membership Plan</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="Addplan">
                  <a href="manage_plan">
                  <i class="fa fa-square"></i>Add Membership Plan
                  </a>
               </li>
               <li id="plan">
                  <a href="membership_plan">
                  <i class="fa fa-square"></i>Membership Plan <span class="label label-primary pull-right"><?php echo getRowCount("select count(plan_id) from  membership_plan", $DatabaseCoCount);?></span>
                  </a>
               </li>
            </ul>
         </li>
         
         <li class="treeview" id="approval">
            <a href="javascript:;">
            <i class="fa fa-check-square-o"></i>
            <span>Appprovals</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               
              <li id="about-approve">
                  <a href="about_me_approval">
                  <i class="fa fa-square"></i>About Me Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register WHERE profile_text !='' ",$DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="expect-approve">
                  <a href="part_expect_approval">
                  <i class="fa fa-square"></i>Part Expectation Approve
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register WHERE part_expect!='' ",$DatabaseCoCount);?></span>
                  </a>
               </li>
				<li id="aadhaar-approve">
                  <a href="aadhaar_approval">
                  <i class="fa fa-square"></i>Aadhaar Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register WHERE aadhaar_card !='' ",$DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="succ-approve">
                  <a href="success_story_approval">
                  <i class="fa fa-square"></i>Success Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(story_id) from success_story", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="horoscope-approve">
                  <a href="horoscop_approval">
                  <i class="fa fa-square"></i>Horoscope Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register WHERE hor_photo!='' ",$DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="photo1-approve">
                  <a href="photo1_approval">
                  <i class="fa fa-square"></i>Photo1 Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register where photo1!=''", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="photo2-approve">
                  <a href="photo2_approval">
                  <i class="fa fa-square"></i>Photo2 Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register where photo2!=''", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="photo3-approve">
                  <a href="photo3_approval">
                  <i class="fa fa-square"></i>Photo3 Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register where photo3!=''", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="photo4-approve">
                  <a href="photo4_approval">
                  <i class="fa fa-square"></i>Photo4 Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register where photo4!=''", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="photo5-approve">
                  <a href="photo5_approval">
                  <i class="fa fa-square"></i>Photo5 Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register where photo5!=''", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="photo6-approve">
                  <a href="photo6_approval">
                  <i class="fa fa-square"></i>Photo6 Approval
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(index_id) from register where photo6!=''", $DatabaseCoCount);?></span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="advmain">
            <a href="javascript:;">
            <i class="fa fa-file-o"></i>
            <span>Advertise</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="adv">
                  <a href="Advertise">
                  <i class="fa fa-square"></i>Advertisement
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="useractivity">
            <a href="javascript:;">
            <i class="fa fa-user"></i>
            <span>User Activity</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="memexpdet">
                  <a href="memberExpInterestDetail">
                  <i class="fa fa-square"></i>Express Interest
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(ei_id) from expressinterest", $DatabaseCoCount);?></span>
                  </a>
               </li>
               <li id="memmsgdet">
                  <a href="memberMessageDetails">
                  <i class="fa fa-square"></i>Message
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(mes_id) from messages", $DatabaseCoCount);?></span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="cms">
            <a href="javascript:;">
            <i class="fa fa-book"></i>
            <span>Content Management</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="cms_page">
                  <a href="cms_pages">
                  <i class="fa fa-square"></i>CMS Pages <span class="label label-primary pull-right"><?php echo getRowCount("select count(cms_id) from  cms_pages", $DatabaseCoCount);?></span>
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="email-temp">
            <a href="javascript:;">
            <i class="fa fa-files-o"></i>
            <span>Email Templates</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="add-new-email">
                  <a href="addNewEmailTemplate">
                  <i class="fa fa-square"></i>Add New Email Template
                  </a>
               </li>
               <li id="list-email">
                  <a href="EmailTemplates">
                  <i class="fa fa-square"></i>All Email Templates
                  <span class="label label-primary pull-right"><?php echo getRowCount("select count(EMAIL_TEMPLATE_ID) from email_templates", $DatabaseCoCount);?></span>
                  </a>
               </li>
            </ul>
         </li>
         
         <li class="treeview" id="payment">
            <a href="javascript:;">
            <i class="fa fa-money"></i>
            <span>Payment Option</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="pay-add">
                  <a href="PaymentOption">
                  <i class="fa fa-square"></i>Manage Payment Option
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="sales">
            <a href="javascript:;">
            <i class="fa fa-bar-chart"></i>
            <span>Member Report</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="report">
                  <a href="member_report">
                  <i class="fa fa-square"></i>Export Members to Excel File 
                  </a>
               </li>
               <li id="report">
                  <a href="SalesReport">
                  <i class="fa fa-square"></i>Sales Report
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="send-email">
            <a href="javascript:;">
            <i class="fa fa-envelope-o"></i>
            <span>Send Email</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="email-list">
                  <a href="SendEmail">
                  <i class="fa fa-square"></i>Send Email To Members
                  </a>
               </li>
            </ul>
         </li>
         <li class="treeview" id="database">
            <a href="javascript:;">
            <i class="fa fa-download"></i><span>Database Operation</span>
            <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
               <li id="expdata">
                  <a href="DatabaseBackup">
                  <i class="fa fa-square"></i>Database BackUp
                  </a>
               </li>
            </ul>
         </li>
      </ul>
   </section>
</aside>