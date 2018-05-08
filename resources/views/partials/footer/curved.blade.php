<footer class="ui-footer">
	<svg class="ui-footer__curve" viewBox="0 0 1440 97" preserveAspectRatio="none">
		<g id="footer-curve">
			<path d="M0,0 C143.702507,88.7542517 333.547888,114.816217 569.536145,78.1858968 C805.524401,41.5555762 1095.67902,15.4936106 1440,0 L1440,96.0569821 L0,96.0569821 L0,0 Z"></path>
		</g>
	</svg>
	<div class="ui-footer__container">
		<div class="ui-footer__main">
			<div class="ui-footer__connect">
				<a href="#" class="ui-footer__logo">
					<img src="/assets/images/logo-white.png" alt="Logo">
				</a>
				<div class="ui-footer__socials">
					<a class="ui-footer__social instagram" href="#"></a>
					<a class="ui-footer__social twitter" href="#"></a>
					<a class="ui-footer__social facebook" href="#"></a>
				</div>
			</div>
			<div class="ui-footer__related">
				<div class="ui-footer__links">
					<h3 class="ui-footer__links__heading">Links</h3>
					<ul class="ui-footer__links__list">
						<li>
							<a href="#">About us</a>
						</li>
						<li>
							<a href="#">Terms of Use</a>
						</li>
						<li>
							<a href="#">Privacy Policy</a>
						</li>
					</ul>
				</div>
				<div class="ui-footer__links">
					<h3 class="ui-footer__links__heading">Help Center</h3>
					<ul class="ui-footer__links__list">
						<li>
							<a href="#">FAQs</a>
						</li>
						<li>
							<a href="#">Tips</a>
						</li>
						<li>
							<a href="#">Safety</a>
						</li>
						<li><a href="#">Reviews</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="ui-footer__international">
			<!-- Language selector -->
			<div class="ui-footer__language">
				<svg viewBox="0 0 48 48">
					<use xlink:href="#globe"></use>
				</svg>
				<span>English (US)</span>
			</div>
		</div>
		<div class="ui-footer__newsletter text-center">
			<div class="ui-footer__newsletter__subscribe-container">
				<input type="email" placeholder="Enter email for newsletter" required>
				<button class="waves-button-light">Subscribe</button>
			</div>
		</div>
		<div class="ui-footer__separator"></div>
		<div class="ui-footer__coaches-counter"></div>
		<div class="ui-footer__copyright">
			<span>Copyright &copy; {{ date('Y') }} - {{ site('site_title') }}. All rights reserved.</span>
		</div>
	</div>
</footer>