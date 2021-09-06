<?php
script('sciencemesh', 'script');
style('sciencemesh', 'style');
script("sciencemesh", "vendor/simplyedit/simply-edit");
script("sciencemesh", "vendor/simplyedit/simply.everything");
?>
<div id="app">
	<div id="app-navigation">
		<?php print_unescaped($this->inc('navigation/index')); ?>
	</div>
	<div id="app-content">
		<div id="app-content-wrapper" class="viewcontainer">
			<main class="sciencemesh-container sciencemesh-invitations">
				<h1>Contacts</h1>
				<div class="app-content-list">
					<div href="#" class="app-content-list-item">
						<!-- div class="app-content-list-item-star icon-starred"></div -->
						<div class="app-content-list-item-icon" style="background-color: rgb(151, 72, 96);">M</div>
						<div class="app-content-list-item-line-one">michiel@pondersource.nl</div>
						<div class="icon-delete"></div>
					</div>
					<div href="#" class="app-content-list-item">
						<!-- div class="app-content-list-item-star icon-starred"></div -->
						<div class="app-content-list-item-icon" style="background-color: rgb(31, 72, 96);">+</div>
						<!-- div class="app-content-list-item-line-one">Accept an invitation</div -->
						<div class="app-content-list-item-line-one"><input type="text" placeholder="Enter your token here"></div>
						<div class="app-content-list-item-menu">
						 	<div class="icon-add"></div>
						</div>
					</div>
				</div>
			</main>
		</div>
	</div>
</div>
