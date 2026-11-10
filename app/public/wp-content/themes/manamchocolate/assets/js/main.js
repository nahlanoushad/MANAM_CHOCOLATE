/**
 * Manam Chocolate - Main Theme JavaScript
 *
 * Handles:
 * 1. Sticky header scroll state
 * 2. Interactive search overlay / modal
 * 3. Mobile navigation drawer with scroll lock
 * 4. Nested mobile accordions
 * 5. Accessible keyboard navigation for desktop mega menu and dropdowns
 *
 * @package ManamChocolate
 * @since 1.1.0
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initStickyHeader();
		initSearchOverlay();
		initNewsletterModal();
		initMobileDrawer();
		initMobileAccordions();
		initDesktopKeyboardNav();
		initHeroSlideshow();
		initCraftTimeline();
		initDiscoverSection();
		initAjaxAddToCart();
		initFeaturedInCarousel();
		initKarkhanaSlideshow();
		initFooterAccordions();
		initShopFacetFilters();
		initSingleProduct();
		initWorkshopNotificationForm();
		initGiftCardOptions();
		initStoreLocatorTabs();
		initStage5Forms();
		initAboutUsCarousels();
		initScrollReveal();
	});

	/**
	 * 1. Sticky Header scroll listener
	 */
	function initStickyHeader() {
		const header = document.getElementById('masthead');
		if (!header) return;

		let ticking = false;

		function onScroll() {
			const scrollY = window.pageYOffset || document.documentElement.scrollTop;
			const isHome = document.body.classList.contains('home');
			if (scrollY > 15) {
				header.classList.add('is-scrolled');
				if (isHome) {
					header.classList.remove('header--transparent');
				}
			} else {
				header.classList.remove('is-scrolled');
				if (isHome) {
					header.classList.add('header--transparent');
				}
			}
			ticking = false;
		}

		window.addEventListener('scroll', function () {
			if (!ticking) {
				window.requestAnimationFrame(onScroll);
				ticking = true;
			}
		}, { passive: true });

		// Initial check
		onScroll();
	}

	/**
	 * 2. Authentic Predictive Search Drawer (Stage 5.10)
	 */
	function initSearchOverlay() {
		initPredictiveSearchDrawer();
	}

	function initPredictiveSearchDrawer() {
		const searchToggle = document.getElementById('search-toggle-btn');
		const searchDrawer = document.getElementById('search-drawer');
		const searchClose = document.getElementById('search-drawer-close');
		const searchOverlay = document.getElementById('search-drawer-overlay');
		const searchInput = document.getElementById('predictive-search-input');
		const clearBtn = document.getElementById('predictive-search-clear');
		const loadingState = document.getElementById('predictive-search-loading');
		const resultsContainer = document.getElementById('predictive-search-results');
		const footer = document.getElementById('predictive-search-footer');
		const viewAllBtn = document.getElementById('predictive-search-view-all');

		if (!searchDrawer) return;

		let debounceTimer = null;
		let activeIndex = -1;
		let currentItems = [];

		function openDrawer() {
			searchDrawer.removeAttribute('hidden');
			document.body.classList.add('search-drawer-open');
			requestAnimationFrame(function () {
				searchDrawer.classList.add('is-active');
				searchDrawer.setAttribute('open', '');
				if (searchToggle) searchToggle.setAttribute('aria-expanded', 'true');
				if (searchInput) {
					searchInput.focus();
					if (searchInput.value.trim().length >= 2) {
						performSearch(searchInput.value.trim());
					}
				}
			});
		}

		function closeDrawer() {
			searchDrawer.classList.remove('is-active');
			searchDrawer.removeAttribute('open');
			document.body.classList.remove('search-drawer-open');
			if (searchToggle) searchToggle.setAttribute('aria-expanded', 'false');
			setTimeout(function () {
				if (!searchDrawer.classList.contains('is-active')) {
					searchDrawer.setAttribute('hidden', '');
				}
			}, 300);
			if (searchToggle) searchToggle.focus();
		}

		if (searchToggle) {
			searchToggle.addEventListener('click', function (e) {
				e.preventDefault();
				if (searchDrawer.classList.contains('is-active')) {
					closeDrawer();
				} else {
					openDrawer();
				}
			});
		}

		document.querySelectorAll('[data-action="open-search"], .header-search-toggle').forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				openDrawer();
			});
		});

		if (searchClose) {
			searchClose.addEventListener('click', function (e) {
				e.preventDefault();
				closeDrawer();
			});
		}

		if (searchOverlay) {
			searchOverlay.addEventListener('click', function () {
				closeDrawer();
			});
		}

		// Clear search query
		if (clearBtn && searchInput) {
			clearBtn.addEventListener('click', function (e) {
				e.preventDefault();
				searchInput.value = '';
				clearBtn.hidden = true;
				resetResults();
				searchInput.focus();
			});
		}

		function resetResults() {
			if (resultsContainer) {
				resultsContainer.innerHTML = '<div class="predictive-search__initial-state"><p class="predictive-search__prompt-text">Search our craft chocolates, tablets, collections, and gifting selections.</p></div>';
			}
			if (footer) footer.hidden = true;
			if (loadingState) loadingState.hidden = true;
			activeIndex = -1;
			currentItems = [];
		}

		function performSearch(query) {
			if (loadingState) loadingState.hidden = false;

			const ajaxUrl = (window.manamSettings && window.manamSettings.ajaxUrl)
				? window.manamSettings.ajaxUrl
				: '/wp-admin/admin-ajax.php';

			const endpoint = ajaxUrl + '?action=manamchocolate_predictive_search&q=' + encodeURIComponent(query);

			fetch(endpoint)
				.then(function (res) { return res.json(); })
				.then(function (response) {
					if (loadingState) loadingState.hidden = true;
					if (!response || !response.success || !response.data) {
						renderNoResults(query);
						return;
					}

					const data = response.data;
					if (data.total === 0 || !data.products || data.products.length === 0) {
						renderNoResults(query);
					} else {
						renderResults(data);
					}
				})
				.catch(function (err) {
					console.error('Search error:', err);
					if (loadingState) loadingState.hidden = true;
					renderNoResults(query);
				});
		}

		function renderNoResults(query) {
			if (!resultsContainer) return;
			resultsContainer.innerHTML = `
				<div class="predictive-search__no-results">
					<p class="no-results-text">No results found for “${escapeHtml(query)}”.</p>
					<p class="no-results-subtext">Check your spelling or explore popular categories like Tablet, Dark Chocolate, Baking, or Gifting.</p>
					<div class="predictive-search__suggestions">
						<button type="button" class="search-suggest-chip" data-search="Tablet">Tablet</button>
						<button type="button" class="search-suggest-chip" data-search="Dark Chocolate">Dark Chocolate</button>
						<button type="button" class="search-suggest-chip" data-search="Gift">Gifting</button>
						<button type="button" class="search-suggest-chip" data-search="Baking">Baking</button>
					</div>
				</div>
			`;

			resultsContainer.querySelectorAll('.search-suggest-chip').forEach(function (chip) {
				chip.addEventListener('click', function () {
					if (searchInput) {
						searchInput.value = this.getAttribute('data-search');
						searchInput.dispatchEvent(new Event('input', { bubbles: true }));
						searchInput.focus();
					}
				});
			});

			if (footer) footer.hidden = true;
			activeIndex = -1;
			currentItems = [];
		}

		function renderResults(data) {
			if (!resultsContainer) return;

			let html = '<div class="predictive-search__menu">';
			html += `<p class="predictive-search__menu-title">PRODUCTS (${data.total})</p>`;
			html += '<ul class="predictive-search__product-list" role="list">';

			data.products.forEach(function (product, index) {
				html += `
					<li class="predictive-search__product-item line-item" data-index="${index}">
						<a href="${product.url}" class="line-item__content-wrapper">
							<div class="line-item__image-wrapper">
								<img src="${product.image}" alt="${escapeHtml(product.title)}" class="line-item__image" width="72" height="72" loading="lazy" />
							</div>
							<div class="line-item__info">
								<span class="line-item__title">${escapeHtml(product.title)}</span>
								${product.cacao ? `<span class="line-item__cacao-badge">${escapeHtml(product.cacao)}</span>` : ''}
								<div class="line-item__price-wrap">${product.price_html}</div>
							</div>
							<svg focusable="false" width="16" height="16" class="icon icon--arrow-right line-item__arrow" viewBox="0 0 17 14" fill="none">
								<path d="M1 7h15M10 1l6 6-6 6" stroke="currentColor" stroke-width="1.3"></path>
							</svg>
						</a>
					</li>
				`;
			});

			html += '</ul></div>';
			resultsContainer.innerHTML = html;

			currentItems = resultsContainer.querySelectorAll('.predictive-search__product-item');
			activeIndex = -1;

			if (footer && viewAllBtn) {
				footer.hidden = false;
				viewAllBtn.textContent = `View all results (${data.total})`;
				viewAllBtn.setAttribute('data-target-url', data.view_all);
			}
		}

		function escapeHtml(str) {
			if (!str) return '';
			return String(str)
				.replace(/&/g, '&amp;')
				.replace(/</g, '&lt;')
				.replace(/>/g, '&gt;')
				.replace(/"/g, '&quot;')
				.replace(/'/g, '&#039;');
		}

		if (searchInput) {
			searchInput.addEventListener('input', function () {
				const query = searchInput.value.trim();
				if (clearBtn) {
					clearBtn.hidden = (query.length === 0);
				}

				clearTimeout(debounceTimer);
				if (query.length < 2) {
					resetResults();
					return;
				}

				debounceTimer = setTimeout(function () {
					performSearch(query);
				}, 220);
			});

			searchInput.addEventListener('keydown', function (e) {
				if (e.key === 'ArrowDown') {
					e.preventDefault();
					if (currentItems.length > 0) {
						activeIndex = (activeIndex + 1) % currentItems.length;
						highlightItem(activeIndex);
					}
				} else if (e.key === 'ArrowUp') {
					e.preventDefault();
					if (currentItems.length > 0) {
						activeIndex = (activeIndex - 1 + currentItems.length) % currentItems.length;
						highlightItem(activeIndex);
					}
				} else if (e.key === 'Enter') {
					if (activeIndex >= 0 && currentItems[activeIndex]) {
						e.preventDefault();
						const link = currentItems[activeIndex].querySelector('a');
						if (link) window.location.href = link.href;
					}
				} else if (e.key === 'Escape') {
					e.preventDefault();
					closeDrawer();
				}
			});
		}

		function highlightItem(index) {
			currentItems.forEach(function (el, i) {
				if (i === index) {
					el.classList.add('is-selected');
					el.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
				} else {
					el.classList.remove('is-selected');
				}
			});
		}

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && searchDrawer.classList.contains('is-active')) {
				closeDrawer();
			}
		});
	}

	/**
	 * 2b. Authentic Blinkit Availability Modal (Stage 5.10 Parity)
	 */
	function initNewsletterModal() {
		initBlinkitModal();
	}

	function initBlinkitModal() {
		const emailToggle = document.getElementById('email-toggle-btn');
		const blinkitModal = document.getElementById('newsletter-popup');
		const modalClose = document.getElementById('blinkit-modal-close');
		const modalOverlay = document.getElementById('blinkit-modal-overlay');

		if (!blinkitModal) return;

		function openModal() {
			blinkitModal.removeAttribute('hidden');
			document.body.classList.add('blinkit-modal-open');
			requestAnimationFrame(function () {
				blinkitModal.classList.add('is-active');
				if (emailToggle) emailToggle.setAttribute('aria-expanded', 'true');
				if (modalClose) modalClose.focus();
			});
		}

		function closeModal() {
			blinkitModal.classList.remove('is-active');
			document.body.classList.remove('blinkit-modal-open');
			if (emailToggle) emailToggle.setAttribute('aria-expanded', 'false');
			setTimeout(function () {
				if (!blinkitModal.classList.contains('is-active')) {
					blinkitModal.setAttribute('hidden', '');
				}
			}, 250);
			if (emailToggle) emailToggle.focus();
		}

		if (emailToggle) {
			emailToggle.addEventListener('click', function (e) {
				e.preventDefault();
				const isOpen = blinkitModal.classList.contains('is-active');
				if (isOpen) {
					closeModal();
				} else {
					openModal();
				}
			});
		}

		if (modalClose) {
			modalClose.addEventListener('click', function (e) {
				e.preventDefault();
				closeModal();
			});
		}

		if (modalOverlay) {
			modalOverlay.addEventListener('click', function (e) {
				e.preventDefault();
				closeModal();
			});
		}

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && blinkitModal.classList.contains('is-active')) {
				closeModal();
			}
		});
	}

	/**
	 * 3. Mobile Navigation Drawer & Backdrop
	 */
	function initMobileDrawer() {
		const mobileToggle = document.getElementById('mobile-menu-toggle');
		const mobileDrawer = document.getElementById('mobile-navigation-drawer');
		const drawerClose = document.getElementById('mobile-drawer-close');
		const drawerBackdrop = document.getElementById('mobile-drawer-backdrop');

		if (!mobileToggle || !mobileDrawer) return;

		function openDrawer() {
			mobileDrawer.removeAttribute('hidden');
			requestAnimationFrame(function () {
				mobileDrawer.classList.add('is-open');
				document.body.classList.add('mobile-nav-open');
				mobileToggle.setAttribute('aria-expanded', 'true');
				if (drawerClose) {
					drawerClose.focus();
				}
			});
		}

		function closeDrawer() {
			mobileDrawer.classList.remove('is-open');
			document.body.classList.remove('mobile-nav-open');
			mobileToggle.setAttribute('aria-expanded', 'false');
			setTimeout(function () {
				if (!mobileDrawer.classList.contains('is-open')) {
					mobileDrawer.setAttribute('hidden', '');
				}
			}, 300);
			mobileToggle.focus();
		}

		mobileToggle.addEventListener('click', function (e) {
			e.preventDefault();
			const isOpen = mobileDrawer.classList.contains('is-open');
			if (isOpen) {
				closeDrawer();
			} else {
				openDrawer();
			}
		});

		if (drawerClose) {
			drawerClose.addEventListener('click', function (e) {
				e.preventDefault();
				closeDrawer();
			});
		}

		if (drawerBackdrop) {
			drawerBackdrop.addEventListener('click', function () {
				closeDrawer();
			});
		}

		// Escape key closes mobile drawer
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && mobileDrawer.classList.contains('is-open')) {
				closeDrawer();
			}
		});
	}

	/**
	 * 4. Nested Mobile Accordions
	 */
	function initMobileAccordions() {
		const toggleButtons = document.querySelectorAll('.accordion-toggle-btn');

		toggleButtons.forEach(function (button) {
			button.addEventListener('click', function (e) {
				e.preventDefault();
				const isExpanded = button.getAttribute('aria-expanded') === 'true';
				const item = button.closest('.has-accordion');
				if (!item) return;

				const panel = item.querySelector('.accordion-panel');
				if (!panel) return;

				if (isExpanded) {
					button.setAttribute('aria-expanded', 'false');
					panel.setAttribute('hidden', '');
				} else {
					button.setAttribute('aria-expanded', 'true');
					panel.removeAttribute('hidden');
				}
			});
		});
	}

	/**
	 * 5. Accessible Desktop Keyboard & Dropdown Interactions
	 */
	function initDesktopKeyboardNav() {
		const primaryNav = document.getElementById('site-navigation');
		if (!primaryNav) return;

		const topMenuItems = primaryNav.querySelectorAll('.primary-nav-menu > .menu-item-has-children, .primary-nav-menu > .has-dropdown');
		const nestedItems = primaryNav.querySelectorAll('.nav-dropdown__item.has-dropdown, .dropdown-has-submenu, ul.sub-menu li.menu-item-has-children');

		// Handle Top-Level Dropdowns
		topMenuItems.forEach(function (item) {
			const topLink = item.querySelector(':scope > a, :scope > .menu-link');

			item.addEventListener('mouseenter', function () {
				item.classList.add('is-hovered');
				if (topLink) topLink.setAttribute('aria-expanded', 'true');
			});

			item.addEventListener('mouseleave', function () {
				item.classList.remove('is-hovered');
				if (topLink) topLink.setAttribute('aria-expanded', 'false');
				// Also close any open nested submenus
				item.querySelectorAll('.has-dropdown.is-open').forEach(function (n) {
					n.classList.remove('is-open');
				});
			});
		});

		// Handle Nested Submenus (Click on arrow or click on '#' heading)
		nestedItems.forEach(function (item) {
			const link = item.querySelector(':scope > a');
			const arrow = item.querySelector(':scope > a > .dropdown-arrow-right');

			// Clicking the right arrow toggles submenu
			if (arrow) {
				arrow.addEventListener('click', function (e) {
					e.preventDefault();
					e.stopPropagation();
					const isOpen = item.classList.contains('is-open');
					// Close sibling open items
					const siblings = item.parentElement.querySelectorAll(':scope > .has-dropdown.is-open');
					siblings.forEach(function (sib) {
						if (sib !== item) sib.classList.remove('is-open');
					});
					item.classList.toggle('is-open', !isOpen);
					if (link) link.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
				});
			}

			// If the link itself is '#' or empty, clicking it toggles submenu
			if (link) {
				link.addEventListener('click', function (e) {
					const href = link.getAttribute('href');
					if (!href || href === '#' || href === window.location.href + '#') {
						e.preventDefault();
						const isOpen = item.classList.contains('is-open');
						item.classList.toggle('is-open', !isOpen);
						link.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
					}
				});
			}

			// Hover keeps it active
			item.addEventListener('mouseenter', function () {
				item.classList.add('is-hovered');
			});
			item.addEventListener('mouseleave', function () {
				item.classList.remove('is-hovered');
			});
		});

		// Accessible Keyboard Navigation
		primaryNav.addEventListener('keydown', function (e) {
			const activeEl = document.activeElement;
			if (!activeEl || !primaryNav.contains(activeEl)) return;

			// Handle Escape key
			if (e.key === 'Escape') {
				const openNested = activeEl.closest('.has-dropdown.is-open');
				if (openNested) {
					e.preventDefault();
					openNested.classList.remove('is-open');
					const parentLink = openNested.querySelector(':scope > a');
					if (parentLink) parentLink.focus();
					return;
				}
				const topItem = activeEl.closest('.primary-nav-menu > .menu-item');
				if (topItem && topItem.classList.contains('focus')) {
					e.preventDefault();
					topItem.classList.remove('focus');
					const topLink = topItem.querySelector(':scope > a, :scope > .menu-link');
					if (topLink) {
						topLink.setAttribute('aria-expanded', 'false');
						topLink.focus();
					}
				}
				return;
			}

			// Handle Right Arrow (Enter nested submenu)
			if (e.key === 'ArrowRight') {
				const parentItem = activeEl.closest('.has-dropdown');
				if (parentItem) {
					const nestedMenu = parentItem.querySelector(':scope > .nav-dropdown, :scope > ul.sub-menu');
					if (nestedMenu) {
						e.preventDefault();
						parentItem.classList.add('is-open');
						const firstSubLink = nestedMenu.querySelector('a');
						if (firstSubLink) firstSubLink.focus();
					}
				}
				return;
			}

			// Handle Left Arrow (Exit nested submenu back to parent)
			if (e.key === 'ArrowLeft') {
				const currentSubmenu = activeEl.closest('.nav-dropdown .nav-dropdown, ul.sub-menu ul.sub-menu');
				if (currentSubmenu) {
					e.preventDefault();
					const parentItem = currentSubmenu.closest('.has-dropdown');
					if (parentItem) {
						parentItem.classList.remove('is-open');
						const parentLink = parentItem.querySelector(':scope > a');
						if (parentLink) parentLink.focus();
					}
				}
				return;
			}

			// Handle Up / Down Arrows (Navigate sibling links)
			if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
				const currentLi = activeEl.closest('li');
				if (currentLi) {
					const parentList = currentLi.parentElement;
					if (parentList) {
						const siblings = Array.from(parentList.querySelectorAll(':scope > li > a'));
						const currIdx = siblings.indexOf(activeEl);
						if (currIdx !== -1) {
							e.preventDefault();
							const nextIdx = (e.key === 'ArrowDown')
								? (currIdx + 1) % siblings.length
								: (currIdx - 1 + siblings.length) % siblings.length;
							siblings[nextIdx].focus();
						}
					}
				}
			}
		});

		// Focus handling for top-level menu items
		topMenuItems.forEach(function (item) {
			const links = item.querySelectorAll('a, button');
			const topLink = item.querySelector(':scope > a, :scope > .menu-link');

			links.forEach(function (link) {
				link.addEventListener('focus', function () {
					item.classList.add('focus');
					if (topLink) topLink.setAttribute('aria-expanded', 'true');
				});

				link.addEventListener('blur', function () {
					setTimeout(function () {
						if (!item.contains(document.activeElement)) {
							item.classList.remove('focus');
							if (topLink) topLink.setAttribute('aria-expanded', 'false');
						}
					}, 15);
				});
			});
		});
	}

	/**
	 * Promotional Hero Slideshow (Diwali 2026 Campaign)
	 *
	 * - Automatic rotation every 5000ms
	 * - Smooth crossfade transition between slides
	 * - Linear progress bar indicators with CSS keyframe animation
	 * - Pause on hover or focus
	 * - Keyboard navigation (Left / Right arrows)
	 * - Touch swipe gesture support for mobile devices
	 * - Accessible tablist / tab / panel ARIA semantics
	 * - Respects prefers-reduced-motion media query
	 */
	function initHeroSlideshow() {
		var slideshow = document.getElementById('hero-promotional-slideshow');
		if (!slideshow) return;

		var slides = slideshow.querySelectorAll('.hero-slide');
		var progressBtns = slideshow.querySelectorAll('.hero-progress-btn');
		var total = slides.length;
		if (total <= 1) return;

		var currentIndex = 0;
		var intervalTime = parseInt(slideshow.dataset.interval, 10) || 5000;
		var timer = null;
		var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

		function goToSlide(index) {
			if (index < 0) {
				index = total - 1;
			} else if (index >= total) {
				index = 0;
			}

			currentIndex = index;

			slides.forEach(function (slide, i) {
				var isTarget = (i === currentIndex);
				slide.classList.toggle('is-active', isTarget);
				slide.setAttribute('aria-hidden', isTarget ? 'false' : 'true');
			});

			progressBtns.forEach(function (btn, i) {
				var isTarget = (i === currentIndex);
				btn.classList.toggle('is-active', isTarget);
				btn.setAttribute('aria-selected', isTarget ? 'true' : 'false');
				btn.setAttribute('aria-current', isTarget ? 'true' : 'false');
				btn.tabIndex = isTarget ? 0 : -1;

				if (isTarget) {
					var fill = btn.querySelector('.hero-progress-bar-fill');
					if (fill) {
						fill.style.animation = 'none';
						void fill.offsetWidth; // trigger reflow to reset keyframe animation
						fill.style.animation = '';
					}
				}
			});
		}

		function startAutoplay() {
			stopAutoplay();
			if (prefersReducedMotion) return;
			timer = setInterval(function () {
				goToSlide(currentIndex + 1);
			}, intervalTime);
		}

		function stopAutoplay() {
			if (timer) {
				clearInterval(timer);
				timer = null;
			}
		}

		// Progress button click handlers
		progressBtns.forEach(function (btn, i) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				goToSlide(i);
				startAutoplay();
			});
		});

		// Hover and focus pause behavior
		slideshow.addEventListener('mouseenter', stopAutoplay);
		slideshow.addEventListener('mouseleave', function () {
			if (!slideshow.matches(':hover') && !slideshow.contains(document.activeElement)) {
				startAutoplay();
			}
		});

		slideshow.addEventListener('focusin', stopAutoplay);
		slideshow.addEventListener('focusout', function (e) {
			if (!slideshow.contains(e.relatedTarget)) {
				startAutoplay();
			}
		});

		// Keyboard arrow navigation
		slideshow.addEventListener('keydown', function (e) {
			if (e.key === 'ArrowRight') {
				e.preventDefault();
				goToSlide(currentIndex + 1);
				if (progressBtns[currentIndex]) {
					progressBtns[currentIndex].focus();
				}
				startAutoplay();
			} else if (e.key === 'ArrowLeft') {
				e.preventDefault();
				goToSlide(currentIndex - 1);
				if (progressBtns[currentIndex]) {
					progressBtns[currentIndex].focus();
				}
				startAutoplay();
			}
		});

		// Touch swipe gestures for mobile
		var touchStartX = 0;
		var touchStartY = 0;
		var touchEndX = 0;
		var touchEndY = 0;

		slideshow.addEventListener('touchstart', function (e) {
			stopAutoplay();
			if (e.changedTouches && e.changedTouches[0]) {
				touchStartX = e.changedTouches[0].screenX;
				touchStartY = e.changedTouches[0].screenY;
			}
		}, { passive: true });

		slideshow.addEventListener('touchend', function (e) {
			if (e.changedTouches && e.changedTouches[0]) {
				touchEndX = e.changedTouches[0].screenX;
				touchEndY = e.changedTouches[0].screenY;
				var diffX = touchEndX - touchStartX;
				var diffY = touchEndY - touchStartY;

				if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
					if (diffX < 0) {
						goToSlide(currentIndex + 1);
					} else {
						goToSlide(currentIndex - 1);
					}
				}
			}
			startAutoplay();
		}, { passive: true });

		// Initialize
		goToSlide(0);
		startAutoplay();
	}

	/**
	 * 6. Our Craft - Interactive Stage Timeline & Original Video Loops
	 */
	function initCraftTimeline() {
		const timeline = document.getElementById('craft-timeline');
		if (!timeline) return;

		const tabs = Array.from(timeline.querySelectorAll('.craft-nav-tab'));
		const cards = Array.from(timeline.querySelectorAll('.craft-stage-card'));
		const prevBtn = document.getElementById('craft-arrow-prev');
		const nextBtn = document.getElementById('craft-arrow-next');
		const progressBar = document.getElementById('craft-progress-bar');
		const total = cards.length;
		if (total === 0) return;

		let currentIndex = 0;
		const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		let isSectionInView = false;

		function playActiveVideo() {
			if (prefersReducedMotion || !isSectionInView) return;
			const activeCard = cards[currentIndex];
			if (!activeCard) return;
			const video = activeCard.querySelector('.craft-stage-video');
			if (video) {
				video.play().then(function () {
					video.classList.add('is-playing');
				}).catch(function () {
					// Autoplay policy or video pending
				});
			}
		}

		function pauseInactiveVideos() {
			cards.forEach(function (card, i) {
				const video = card.querySelector('.craft-stage-video');
				if (!video) return;
				if (i !== currentIndex) {
					video.pause();
					video.currentTime = 0;
					video.classList.remove('is-playing');
				}
			});
		}

		function setActiveStage(index, scrollTab) {
			if (index < 0) index = 0;
			if (index >= total) index = total - 1;
			currentIndex = index;

			// Update cards
			cards.forEach(function (card, i) {
				const isActive = (i === currentIndex);
				card.classList.toggle('is-active', isActive);
				card.setAttribute('aria-hidden', isActive ? 'false' : 'true');
			});

			// Pause inactive videos and play active video
			pauseInactiveVideos();
			playActiveVideo();

			// Update tabs
			tabs.forEach(function (tab, i) {
				const isActive = (i === currentIndex);
				tab.classList.toggle('is-active', isActive);
				tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
				if (isActive && scrollTab) {
					tab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
				}
			});

			// Update progress bar (0% to 100%)
			if (progressBar) {
				const pct = ((currentIndex + 1) / total) * 100;
				progressBar.style.width = pct + '%';
			}

			// Update prev/next arrows
			if (prevBtn) {
				prevBtn.disabled = (currentIndex === 0);
			}
			if (nextBtn) {
				nextBtn.disabled = (currentIndex === total - 1);
			}
		}

		// Tab clicks
		tabs.forEach(function (tab, i) {
			tab.addEventListener('click', function (e) {
				e.preventDefault();
				setActiveStage(i, true);
			});
		});

		// Arrow clicks
		if (prevBtn) {
			prevBtn.addEventListener('click', function () {
				if (currentIndex > 0) {
					setActiveStage(currentIndex - 1, true);
				}
			});
		}
		if (nextBtn) {
			nextBtn.addEventListener('click', function () {
				if (currentIndex < total - 1) {
					setActiveStage(currentIndex + 1, true);
				}
			});
		}

		// Keyboard navigation for tabs
		timeline.addEventListener('keydown', function (e) {
			if (e.key === 'ArrowLeft') {
				if (currentIndex > 0) {
					setActiveStage(currentIndex - 1, true);
					tabs[currentIndex].focus();
				}
			} else if (e.key === 'ArrowRight') {
				if (currentIndex < total - 1) {
					setActiveStage(currentIndex + 1, true);
					tabs[currentIndex].focus();
				}
			}
		});

		// Section visibility observer for video lifecycle
		const craftSection = document.getElementById('our-craft-section') || timeline;
		if ('IntersectionObserver' in window) {
			const craftObserver = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					isSectionInView = entry.isIntersecting;
					if (isSectionInView) {
						playActiveVideo();
					} else {
						const activeCard = cards[currentIndex];
						const video = activeCard ? activeCard.querySelector('.craft-stage-video') : null;
						if (video) video.pause();
					}
				});
			}, { threshold: 0.15 });
			craftObserver.observe(craftSection);
		} else {
			isSectionInView = true;
		}

		// Initial state (do not scroll on page load)
		setActiveStage(0, false);
	}

	/**
	 * 7. Discover Products Section (Tabs, Carousel & Keyboard Navigation)
	 */
	function initDiscoverSection() {
		var section = document.getElementById('discover-products');
		if (!section) return;

		var tabButtons = section.querySelectorAll('.discover-tab-btn');
		var tabPanes = section.querySelectorAll('.discover-tab-pane');

		function switchTab(slug) {
			tabButtons.forEach(function (btn) {
				var isMatch = btn.getAttribute('data-tab-slug') === slug;
				btn.classList.toggle('active', isMatch);
				btn.setAttribute('aria-selected', isMatch ? 'true' : 'false');
				btn.setAttribute('tabindex', isMatch ? '0' : '-1');
			});

			tabPanes.forEach(function (pane) {
				var isMatch = pane.id === 'discover-tab-pane-' + slug;
				pane.classList.toggle('active', isMatch);
				if (isMatch) {
					pane.removeAttribute('hidden');
					var slider = pane.querySelector('.discover-products-slider');
					if (slider) {
						updateSliderNav(slider);
					}
				} else {
					pane.setAttribute('hidden', '');
				}
			});
		}

		tabButtons.forEach(function (btn, index) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var slug = btn.getAttribute('data-tab-slug');
				switchTab(slug);
			});

			btn.addEventListener('keydown', function (e) {
				var targetIndex = -1;
				if (e.key === 'ArrowRight') {
					targetIndex = (index + 1) % tabButtons.length;
				} else if (e.key === 'ArrowLeft') {
					targetIndex = (index - 1 + tabButtons.length) % tabButtons.length;
				}

				if (targetIndex !== -1) {
					e.preventDefault();
					var targetBtn = tabButtons[targetIndex];
					targetBtn.focus();
					switchTab(targetBtn.getAttribute('data-tab-slug'));
				}
			});
		});

		// Slider carousel arrows state calculation
		function updateSliderNav(slider) {
			if (!slider) return;
			var pane = slider.closest('.discover-tab-pane');
			if (!pane) return;

			var prevBtn = pane.querySelector('.discover-nav-prev');
			var nextBtn = pane.querySelector('.discover-nav-next');
			if (!prevBtn || !nextBtn) return;

			var scrollLeft = slider.scrollLeft;
			var maxScroll = slider.scrollWidth - slider.clientWidth;

			prevBtn.disabled = (scrollLeft <= 5);
			nextBtn.disabled = (scrollLeft >= maxScroll - 5);
		}

		// Setup each slider
		var sliders = section.querySelectorAll('.discover-products-slider');
		sliders.forEach(function (slider) {
			var ticking = false;
			slider.addEventListener('scroll', function () {
				if (!ticking) {
					window.requestAnimationFrame(function () {
						updateSliderNav(slider);
						ticking = false;
					});
					ticking = true;
				}
			}, { passive: true });

			// Initial check
			updateSliderNav(slider);
		});

		// Setup Prev / Next arrow buttons
		var navArrows = section.querySelectorAll('.discover-nav-arrow');
		navArrows.forEach(function (arrow) {
			arrow.addEventListener('click', function () {
				var targetId = arrow.getAttribute('data-slider-target');
				var slider = document.getElementById(targetId);
				if (!slider) return;

				var card = slider.querySelector('.product-item-card');
				var step = card ? (card.offsetWidth + 24) : (slider.clientWidth * 0.75);
				var direction = arrow.classList.contains('discover-nav-prev') ? -1 : 1;

				slider.scrollBy({
					left: direction * step,
					behavior: 'smooth'
				});
			});
		});
	}

	/**
	 * 8. AJAX Add to Cart & Header Cart Badge Update
	 */
	function initAjaxAddToCart() {
		var cartBadge = document.getElementById('header-cart-count');

		function bumpBadge() {
			cartBadge = document.getElementById('header-cart-count');
			if (!cartBadge) return;
			cartBadge.classList.remove('cart-bump');
			void cartBadge.offsetWidth; // Force reflow
			cartBadge.classList.add('cart-bump');
			setTimeout(function () {
				cartBadge.classList.remove('cart-bump');
			}, 450);
		}

		// Delegate clicks on .btn-add-to-cart
		document.addEventListener('click', function (e) {
			var btn = e.target.closest('.btn-add-to-cart');
			if (!btn || btn.classList.contains('is-disabled') || btn.classList.contains('is-loading')) {
				return;
			}

			var productId = btn.getAttribute('data-product_id') || btn.getAttribute('value');
			if (!productId && btn.form) {
				var addInput = btn.form.querySelector('input[name="add-to-cart"]');
				if (addInput) productId = addInput.value;
			}
			if (!productId) return;

			e.preventDefault();
			btn.classList.add('is-loading');

			var endpoint = (window.manamSettings && window.manamSettings.wcAjaxUrl)
				? window.manamSettings.wcAjaxUrl.replace('%%endpoint%%', 'add_to_cart')
				: '/?wc-ajax=add_to_cart';

			var quantity = 1;
			var formData;
			if (btn.form) {
				if (!btn.form.checkValidity()) {
					btn.form.reportValidity();
					btn.classList.remove('is-loading');
					return;
				}
				formData = new FormData(btn.form);
				if (!formData.has('product_id')) {
					formData.append('product_id', productId);
				}
				if (!formData.has('add-to-cart')) {
					formData.append('add-to-cart', productId);
				}
			} else {
				formData = new FormData();
				formData.append('product_id', productId);
				formData.append('add-to-cart', productId);
				formData.append('quantity', quantity);
			}

			fetch(endpoint, {
				method: 'POST',
				body: formData,
				headers: {
					'Accept': 'application/json, text/javascript, */*; q=0.01'
				}
			})
			.then(function (response) {
				return response.json();
			})
			.then(function (data) {
				btn.classList.remove('is-loading');

				if (data && data.error && data.product_url) {
					window.location.href = data.product_url;
					return;
				}

				// Button success feedback
				btn.classList.add('is-added');
				var textSpan = btn.querySelector('.btn-text');
				var origText = textSpan ? textSpan.textContent : '';
				if (textSpan) {
					textSpan.textContent = (window.manamSettings && window.manamSettings.addedToCart) || 'Added!';
				}

				setTimeout(function () {
					btn.classList.remove('is-added');
					if (textSpan) {
						textSpan.textContent = origText;
					}
				}, 1600);

				// Update fragments if returned
				if (data && data.fragments) {
					for (var selector in data.fragments) {
						if (Object.prototype.hasOwnProperty.call(data.fragments, selector)) {
							var elements = document.querySelectorAll(selector);
							elements.forEach(function (el) {
								var tempDiv = document.createElement('div');
								tempDiv.innerHTML = data.fragments[selector];
								if (tempDiv.firstElementChild) {
									el.replaceWith(tempDiv.firstElementChild);
								}
							});
						}
					}
					bumpBadge();
				} else {
					// Fallback count increment
					var currentCount = parseInt(cartBadge ? cartBadge.textContent : '0', 10) || 0;
					if (cartBadge) {
						cartBadge.textContent = currentCount + quantity;
					}
					bumpBadge();
				}

				// Trigger jQuery event if available for third-party scripts
				if (window.jQuery) {
					window.jQuery(document.body).trigger('added_to_cart', [data ? data.fragments : null, data ? data.cart_hash : null, window.jQuery(btn)]);
				}
			})
			.catch(function (err) {
				console.error('Add to cart error:', err);
				btn.classList.remove('is-loading');
			});
		});

		// Listen to jQuery added_to_cart event from WooCommerce's native script if active
		if (window.jQuery) {
			window.jQuery(document.body).on('added_to_cart', function () {
				bumpBadge();
			});
		}
	}

	/**
	 * 9. Featured In Editorial Carousel (Synchronized Quotes, Logos & Mobile Touch)
	 */
	function initFeaturedInCarousel() {
		var section = document.getElementById('featured-in');
		if (!section) return;

		var quotes = section.querySelectorAll('.featured-quote-item');
		var dots = section.querySelectorAll('.featured-dot-btn');
		var logos = section.querySelectorAll('.featured-logo-item');
		var prevBtn = section.querySelector('.featured-nav-prev');
		var nextBtn = section.querySelector('.featured-nav-next');
		var carouselWrapper = section.querySelector('.featured-quotes-wrapper');

		if (!quotes.length) return;

		var total = quotes.length;
		var currentIndex = 0;

		function goToSlide(index) {
			if (index < 0) {
				index = total - 1;
			} else if (index >= total) {
				index = 0;
			}

			currentIndex = index;

			// Update quotes
			quotes.forEach(function (quote, i) {
				var isTarget = (i === currentIndex);
				quote.classList.toggle('is-active', isTarget);
				if (isTarget) {
					quote.removeAttribute('hidden');
				} else {
					quote.setAttribute('hidden', '');
				}
			});

			// Update mobile dots
			dots.forEach(function (dot, i) {
				var isTarget = (i === currentIndex);
				dot.classList.toggle('is-active', isTarget);
				dot.setAttribute('aria-selected', isTarget ? 'true' : 'false');
			});

			// Update logos highlight & scroll into view on mobile
			logos.forEach(function (logo, i) {
				var isTarget = (i === currentIndex);
				logo.classList.toggle('is-active', isTarget);
				if (isTarget) {
					var scroller = logo.closest('.featured-in-logos-scroller');
					if (scroller && scroller.scrollWidth > scroller.clientWidth) {
						var logoLeft = logo.offsetLeft - 24;
						scroller.scrollTo({
							left: Math.max(0, logoLeft),
							behavior: 'smooth'
						});
					}
				}
			});
		}

		// Arrow click listeners
		if (prevBtn) {
			prevBtn.addEventListener('click', function (e) {
				e.preventDefault();
				goToSlide(currentIndex - 1);
			});
		}

		if (nextBtn) {
			nextBtn.addEventListener('click', function (e) {
				e.preventDefault();
				goToSlide(currentIndex + 1);
			});
		}

		// Dots click listeners
		dots.forEach(function (dot, i) {
			dot.addEventListener('click', function (e) {
				e.preventDefault();
				goToSlide(i);
			});
		});

		// Logos click listeners to jump to corresponding quote
		logos.forEach(function (logo, i) {
			logo.addEventListener('click', function (e) {
				// If clicking without Cmd/Ctrl, navigate to the slide
				if (!e.metaKey && !e.ctrlKey) {
					e.preventDefault();
					goToSlide(i);
				}
			});
		});

		// Keyboard arrow navigation
		section.addEventListener('keydown', function (e) {
			if (e.key === 'ArrowLeft') {
				goToSlide(currentIndex - 1);
			} else if (e.key === 'ArrowRight') {
				goToSlide(currentIndex + 1);
			}
		});

		// Touch swipe gestures on mobile
		if (carouselWrapper) {
			var touchStartX = 0;
			var touchStartY = 0;
			var touchEndX = 0;
			var touchEndY = 0;

			carouselWrapper.addEventListener('touchstart', function (e) {
				touchStartX = e.changedTouches[0].screenX;
				touchStartY = e.changedTouches[0].screenY;
			}, { passive: true });

			carouselWrapper.addEventListener('touchend', function (e) {
				touchEndX = e.changedTouches[0].screenX;
				touchEndY = e.changedTouches[0].screenY;
				handleSwipe();
			}, { passive: true });

			function handleSwipe() {
				var diffX = touchEndX - touchStartX;
				var diffY = touchEndY - touchStartY;

				// Ensure horizontal swipe is dominant and exceeds threshold
				if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
					if (diffX < 0) {
						// Swiped Left -> Next
						goToSlide(currentIndex + 1);
					} else {
						// Swiped Right -> Prev
						goToSlide(currentIndex - 1);
					}
				}
			}
		}

		// Initial display
		goToSlide(0);
	}

	/**
	 * 10. Manam Chocolate Karkhana Slideshow (Autoplay, Progress Indicators & Touch Swipe)
	 */
	function initKarkhanaSlideshow() {
		var slideshow = document.getElementById('karkhana-slideshow');
		if (!slideshow) return;

		var slides = slideshow.querySelectorAll('.karkhana-slide');
		var progressBtns = slideshow.querySelectorAll('.karkhana-progress-btn');
		if (!slides.length) return;

		var total = slides.length;
		var currentIndex = 0;
		var intervalTime = 5000;
		var timer = null;

		function goToSlide(index) {
			if (index < 0) {
				index = total - 1;
			} else if (index >= total) {
				index = 0;
			}

			currentIndex = index;

			slides.forEach(function (slide, i) {
				var isTarget = (i === currentIndex);
				slide.classList.toggle('is-active', isTarget);
				if (isTarget) {
					slide.removeAttribute('hidden');
				} else {
					slide.setAttribute('hidden', '');
				}
			});

			progressBtns.forEach(function (btn, i) {
				var isTarget = (i === currentIndex);
				btn.classList.toggle('is-active', isTarget);
				btn.setAttribute('aria-selected', isTarget ? 'true' : 'false');
			});
		}

		function startAutoplay() {
			stopAutoplay();
			timer = setInterval(function () {
				goToSlide(currentIndex + 1);
			}, intervalTime);
		}

		function stopAutoplay() {
			if (timer) {
				clearInterval(timer);
				timer = null;
			}
		}

		// Progress button clicks
		progressBtns.forEach(function (btn, i) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				goToSlide(i);
				startAutoplay();
			});
		});

		// Pause autoplay on mouse enter / hover
		slideshow.addEventListener('mouseenter', stopAutoplay);
		slideshow.addEventListener('mouseleave', startAutoplay);

		// Touch swipe gestures
		var touchStartX = 0;
		var touchStartY = 0;
		var touchEndX = 0;
		var touchEndY = 0;

		slideshow.addEventListener('touchstart', function (e) {
			stopAutoplay();
			touchStartX = e.changedTouches[0].screenX;
			touchStartY = e.changedTouches[0].screenY;
		}, { passive: true });

		slideshow.addEventListener('touchend', function (e) {
			touchEndX = e.changedTouches[0].screenX;
			touchEndY = e.changedTouches[0].screenY;
			handleSwipe();
			startAutoplay();
		}, { passive: true });

		function handleSwipe() {
			var diffX = touchEndX - touchStartX;
			var diffY = touchEndY - touchStartY;

			if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
				if (diffX < 0) {
					goToSlide(currentIndex + 1);
				} else {
					goToSlide(currentIndex - 1);
				}
			}
		}

		// Initial display & start
		goToSlide(0);
		startAutoplay();
	}

	/**
	 * 11. Mobile Footer Accordion Toggles
	 */
	function initFooterAccordions() {
		var toggles = document.querySelectorAll('.footer-accordion-toggle');
		if (!toggles.length) return;

		toggles.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var targetId = btn.getAttribute('aria-controls');
				var content = document.getElementById(targetId);
				if (!content) return;

				var isExpanded = btn.getAttribute('aria-expanded') === 'true';
				btn.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
				content.classList.toggle('is-open', !isExpanded);
			});
		});
	}

	/**
	 * 12. Shop Facet Filters & Mobile Filter Drawer
	 */
	function initShopFacetFilters() {
		// A. Mobile Drawer Open/Close
		var filterTrigger = document.getElementById('mobile-filter-trigger');
		var filterDrawer = document.getElementById('mobile-filter-drawer');
		var filterClose = document.getElementById('mobile-filter-close');
		var filterBackdrop = document.getElementById('mobile-filter-backdrop');
		var filterApply = document.getElementById('mobile-filter-apply-btn');

		function openDrawer() {
			if (!filterDrawer) return;
			filterDrawer.removeAttribute('hidden');
			document.body.style.overflow = 'hidden';
			if (filterTrigger) {
				filterTrigger.setAttribute('aria-expanded', 'true');
			}
		}

		function closeDrawer() {
			if (!filterDrawer) return;
			filterDrawer.setAttribute('hidden', '');
			document.body.style.overflow = '';
			if (filterTrigger) {
				filterTrigger.setAttribute('aria-expanded', 'false');
			}
		}

		if (filterTrigger) {
			filterTrigger.addEventListener('click', function (e) {
				e.preventDefault();
				openDrawer();
			});
		}

		if (filterClose) {
			filterClose.addEventListener('click', function (e) {
				e.preventDefault();
				closeDrawer();
			});
		}

		if (filterBackdrop) {
			filterBackdrop.addEventListener('click', function (e) {
				e.preventDefault();
				closeDrawer();
			});
		}

		if (filterApply) {
			filterApply.addEventListener('click', function (e) {
				e.preventDefault();
				closeDrawer();
			});
		}

		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && filterDrawer && !filterDrawer.hasAttribute('hidden')) {
				closeDrawer();
			}
		});

		// B. Filter Sidebar Accordion Headers
		var accordionHeaders = document.querySelectorAll('.filter-group-header');
		accordionHeaders.forEach(function (header) {
			header.addEventListener('click', function () {
				var isExpanded = header.getAttribute('aria-expanded') === 'true';
				header.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
				var content = header.nextElementSibling;
				if (content) {
					content.style.display = isExpanded ? 'none' : 'block';
				}
			});
		});

		// C. Dual Range Slider Sync
		var rangeMin = document.querySelector('.price-range-slider.range-min');
		var rangeMax = document.querySelector('.price-range-slider.range-max');
		var inputMin = document.getElementById('price-input-min');
		var inputMax = document.getElementById('price-input-max');
		var highlight = document.getElementById('price-range-highlight');

		if (rangeMin && rangeMax && highlight) {
			var minLimit = parseFloat(rangeMin.min) || 0;
			var maxLimit = parseFloat(rangeMax.max) || 1000;

			function updateTrack() {
				var valMin = parseFloat(rangeMin.value) || minLimit;
				var valMax = parseFloat(rangeMax.value) || maxLimit;
				if (valMin > valMax) {
					var tmp = valMin;
					valMin = valMax;
					valMax = tmp;
				}
				var leftPercent = ((valMin - minLimit) / (maxLimit - minLimit)) * 100;
				var rightPercent = 100 - (((valMax - minLimit) / (maxLimit - minLimit)) * 100);
				highlight.style.left = leftPercent + '%';
				highlight.style.right = rightPercent + '%';
			}

			rangeMin.addEventListener('input', function () {
				if (parseFloat(rangeMin.value) > parseFloat(rangeMax.value)) {
					rangeMin.value = rangeMax.value;
				}
				if (inputMin) inputMin.value = rangeMin.value;
				updateTrack();
			});

			rangeMax.addEventListener('input', function () {
				if (parseFloat(rangeMax.value) < parseFloat(rangeMin.value)) {
					rangeMax.value = rangeMin.value;
				}
				if (inputMax) inputMax.value = rangeMax.value;
				updateTrack();
			});

			if (inputMin) {
				inputMin.addEventListener('change', function () {
					var v = parseFloat(inputMin.value);
					if (!isNaN(v)) {
						rangeMin.value = Math.max(minLimit, Math.min(v, parseFloat(rangeMax.value)));
						updateTrack();
					}
				});
			}

			if (inputMax) {
				inputMax.addEventListener('change', function () {
					var v = parseFloat(inputMax.value);
					if (!isNaN(v)) {
						rangeMax.value = Math.min(maxLimit, Math.max(v, parseFloat(rangeMin.value)));
						updateTrack();
					}
				});
			}

			updateTrack();
		}
	}

	/**
	 * 13. Phase 12: Single Product Interactive Experience
	 */
	function initSingleProduct() {
		// A. Interactive Gallery Thumbnails
		var thumbnails = document.querySelectorAll('.product__thumbnail-item');
		var mainPhoto = document.getElementById('product-main-view');

		thumbnails.forEach(function (thumb) {
			thumb.addEventListener('click', function (e) {
				e.preventDefault();
				var largeSrc = thumb.getAttribute('data-large-src');
				var altText = thumb.getAttribute('data-alt');

				if (mainPhoto && largeSrc) {
					mainPhoto.src = largeSrc;
					if (altText) {
						mainPhoto.alt = altText;
					}
				}

				thumbnails.forEach(function (t) {
					t.classList.remove('is-active');
					t.setAttribute('aria-selected', 'false');
				});
				thumb.classList.add('is-active');
				thumb.setAttribute('aria-selected', 'true');
			});
		});

		// B. Quantity Increment / Decrement Selector
		var qtyWrap = document.querySelector('.quantity-selector-wrap');
		if (qtyWrap) {
			var qtyMinus = qtyWrap.querySelector('.qty-minus');
			var qtyPlus = qtyWrap.querySelector('.qty-plus');
			var qtyInput = qtyWrap.querySelector('.qty-input');

			if (qtyMinus && qtyPlus && qtyInput) {
				qtyMinus.addEventListener('click', function (e) {
					e.preventDefault();
					var currentVal = parseInt(qtyInput.value, 10) || 1;
					var minVal = parseInt(qtyInput.getAttribute('min'), 10) || 1;
					if (currentVal > minVal) {
						qtyInput.value = currentVal - 1;
						qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
					}
				});

				qtyPlus.addEventListener('click', function (e) {
					e.preventDefault();
					var currentVal = parseInt(qtyInput.value, 10) || 1;
					var maxAttr = qtyInput.getAttribute('max');
					var maxVal = maxAttr ? parseInt(maxAttr, 10) : Infinity;
					if (currentVal < maxVal) {
						qtyInput.value = currentVal + 1;
						qtyInput.dispatchEvent(new Event('change', { bubbles: true }));
					}
				});

				qtyInput.addEventListener('change', function () {
					var val = parseInt(this.value, 10);
					var minVal = parseInt(this.getAttribute('min'), 10) || 1;
					var maxAttr = this.getAttribute('max');
					var maxVal = maxAttr ? parseInt(maxAttr, 10) : Infinity;

					if (isNaN(val) || val < minVal) {
						val = minVal;
					} else if (val > maxVal) {
						val = maxVal;
					}
					this.value = val;
				});
			}
		}

		// C. Delivery Pincode Checker
		var pinInput = document.getElementById('pincode-input');
		var pinBtn = document.getElementById('pincode-check-btn');
		var pinFeedback = document.getElementById('pincode-feedback');

		function validatePincode() {
			if (!pinInput || !pinFeedback) return;
			var pin = pinInput.value.trim();
			var pinRegex = /^[1-9][0-9]{5}$/;

			if (!pin) {
				pinFeedback.className = 'pincode-feedback-message is-invalid';
				pinFeedback.textContent = 'Please enter a 6-digit Indian pincode.';
				return;
			}

			if (!pinRegex.test(pin)) {
				pinFeedback.className = 'pincode-feedback-message is-invalid';
				pinFeedback.textContent = 'Please enter a valid 6-digit Indian pincode (e.g. 500034).';
				return;
			}

			pinFeedback.className = 'pincode-feedback-message is-valid';
			pinFeedback.innerHTML = 'Delivery is available to ' + pin + '. Estimated delivery in 2–4 business days.';
		}

		if (pinBtn) {
			pinBtn.addEventListener('click', function (e) {
				e.preventDefault();
				validatePincode();
			});
		}

		if (pinInput) {
			pinInput.addEventListener('keydown', function (e) {
				if (e.key === 'Enter') {
					e.preventDefault();
					validatePincode();
				}
			});
		}

		// D. Desktop Tab Switching
		var tabBtns = document.querySelectorAll('.tabs-nav-bar .tab-nav-btn');
		var tabPanels = document.querySelectorAll('.tabs-panels-wrap .tab-panel');

		tabBtns.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var targetId = btn.getAttribute('data-tab-target');

				tabBtns.forEach(function (b) {
					b.classList.remove('is-active');
					b.setAttribute('aria-selected', 'false');
				});
				btn.classList.add('is-active');
				btn.setAttribute('aria-selected', 'true');

				tabPanels.forEach(function (panel) {
					var isTarget = panel.id === targetId;
					panel.classList.toggle('is-active', isTarget);
					var accordionHeader = panel.querySelector('.mobile-accordion-header');
					if (accordionHeader) {
						accordionHeader.setAttribute('aria-expanded', isTarget ? 'true' : 'false');
					}
				});
			});
		});

		// E. Mobile Accordion Toggling
		var accordionHeaders = document.querySelectorAll('.mobile-accordion-header');
		accordionHeaders.forEach(function (header) {
			header.addEventListener('click', function (e) {
				e.preventDefault();
				var panel = header.closest('.tab-panel');
				if (!panel) return;

				var isExpanded = header.getAttribute('aria-expanded') === 'true';
				header.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
				panel.classList.toggle('is-active', !isExpanded);
			});
		});

		// F. Gift Card Denomination Selector
		var denomBtns = document.querySelectorAll('.gift-card-denom-btn');
		var denomInput = document.getElementById('gift_card_denomination_input');
		var activePrice = document.getElementById('gift-card-active-price');

		denomBtns.forEach(function (btn) {
			btn.addEventListener('click', function (e) {
				e.preventDefault();
				var amt = btn.getAttribute('data-amount');
				denomBtns.forEach(function (b) { b.classList.remove('is-active'); });
				btn.classList.add('is-active');
				if (denomInput) {
					denomInput.value = amt;
				}
				if (activePrice) {
					var formatted = parseInt(amt, 10).toLocaleString('en-IN');
					activePrice.innerHTML = 'MRP <span class="amount"><bdi><span class="woocommerce-Price-currencySymbol">&#8377;</span>' + formatted + '</bdi></span>';
				}
			});
		});
	}

	/**
	 * 14. Phase 14: Workshop Notification Form Handling
	 */
	function initWorkshopNotificationForm() {
		var form = document.getElementById('workshop-notification-form');
		if (!form) return;

		var feedback = document.getElementById('workshop-form-feedback');
		var submitBtn = document.getElementById('workshop-submit-btn');
		var emailInput = document.getElementById('workshop-email');
		var phoneInput = document.getElementById('workshop-whatsapp');
		var consentInput = document.getElementById('workshop-consent');

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			if (!feedback) return;

			var email = emailInput ? emailInput.value.trim() : '';
			var phone = phoneInput ? phoneInput.value.trim() : '';
			var consent = consentInput ? consentInput.checked : false;

			// Reset feedback
			feedback.className = 'form-feedback-message';
			feedback.textContent = '';

			// 1. Client-Side Email Validation
			var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			if (!email || !emailRegex.test(email)) {
				feedback.className = 'form-feedback-message is-error';
				feedback.textContent = 'Please enter a valid email address.';
				if (emailInput) emailInput.focus();
				return;
			}

			// 2. Client-Side Indian Phone Validation (10 digits starting with 6,7,8,9)
			var cleanPhone = phone.replace(/\D/g, '');
			var phoneRegex = /^[6-9][0-9]{9}$/;
			if (!cleanPhone || !phoneRegex.test(cleanPhone)) {
				feedback.className = 'form-feedback-message is-error';
				feedback.textContent = 'Please enter a valid 10-digit Indian WhatsApp number (e.g. 9876543210).';
				if (phoneInput) phoneInput.focus();
				return;
			}

			// 3. Consent Check
			if (!consent) {
				feedback.className = 'form-feedback-message is-error';
				feedback.textContent = 'Please check the box to agree to workshop updates.';
				if (consentInput) consentInput.focus();
				return;
			}

			// Form submission state
			if (submitBtn) {
				submitBtn.classList.add('is-loading');
				submitBtn.disabled = true;
			}

			var formData = new FormData(form);
			formData.append('security', form.querySelector('[name="workshop_nonce"]') ? form.querySelector('[name="workshop_nonce"]').value : '');

			var ajaxUrl = (window.manamSettings && window.manamSettings.ajaxUrl) ? window.manamSettings.ajaxUrl : '/wp-admin/admin-ajax.php';

			fetch(ajaxUrl, {
				method: 'POST',
				body: formData
			})
			.then(function (res) {
				return res.json();
			})
			.then(function (data) {
				if (submitBtn) {
					submitBtn.classList.remove('is-loading');
					submitBtn.disabled = false;
				}

				if (data && data.success) {
					feedback.className = 'form-feedback-message is-success';
					feedback.textContent = data.data && data.data.message ? data.data.message : 'Thank you! Your contact details have been recorded.';
					if (emailInput) emailInput.value = '';
					if (phoneInput) phoneInput.value = '';
				} else {
					feedback.className = 'form-feedback-message is-error';
					feedback.textContent = data && data.data && data.data.message ? data.data.message : 'An error occurred. Please try again.';
				}
			})
			.catch(function (err) {
				console.error('Workshop form submission error:', err);
				if (submitBtn) {
					submitBtn.classList.remove('is-loading');
					submitBtn.disabled = false;
				}
				feedback.className = 'form-feedback-message is-error';
				feedback.textContent = 'Unable to submit your details right now. Please try again.';
			});
		});
	}

	/**
	 * 15. Global Scroll Reveal System (Progressive Enhancement)
	 *
	 * - Uses IntersectionObserver for smooth performance
	 * - Applies .is-revealed once element crosses viewport threshold
	 * - Automatically applies staggered delay to [data-reveal-group] children
	 * - Fallback: reveals all elements immediately if IntersectionObserver is unsupported
	 * - Respects prefers-reduced-motion
	 */
	function initScrollReveal() {
		var prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		if (prefersReducedMotion || !('IntersectionObserver' in window)) {
			// No animations or unsupported: ensure everything is visible
			return;
		}

		var revealElements = document.querySelectorAll('[data-reveal]');
		if (!revealElements.length) return;

		// Process [data-reveal-group] elements for automatic stagger
		var groups = document.querySelectorAll('[data-reveal-group]');
		groups.forEach(function (group) {
			var children = group.querySelectorAll('[data-reveal]');
			children.forEach(function (child, idx) {
				if (!child.getAttribute('data-reveal-delay')) {
					child.style.transitionDelay = (idx * 80) + 'ms';
				}
			});
		});

		// Apply individual data-reveal-delay if specified
		revealElements.forEach(function (el) {
			var delay = el.getAttribute('data-reveal-delay');
			if (delay) {
				el.style.transitionDelay = delay + 'ms';
			}
		});

		// Mark document as ready for reveal styles
		document.documentElement.classList.add('has-reveal-ready');

		var observerOptions = {
			root: null,
			rootMargin: '40px 0px',
			threshold: 0.08
		};

		var revealObserver = new IntersectionObserver(function (entries, observer) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-revealed');
					observer.unobserve(entry.target);
				}
			});
		}, observerOptions);

		revealElements.forEach(function (el) {
			// Check if element is already inside viewport or above fold
			var rect = el.getBoundingClientRect();
			if (rect.top < window.innerHeight && rect.bottom > 0) {
				el.classList.add('is-revealed');
			} else {
				revealObserver.observe(el);
			}
		});

		// Safety timeout: ensure everything is revealed after 3.5s in case of edge-case scroll glitch
		setTimeout(function () {
			revealElements.forEach(function (el) {
				if (!el.classList.contains('is-revealed')) {
					el.classList.add('is-revealed');
				}
			});
		}, 3500);
	}

	/**
	 * 16. Gift Card Denominations & Interactive Option Selector
	 */
	function initGiftCardOptions() {
		var denomButtons = document.querySelectorAll('.gift-card-denom-btn');
		var denomInput = document.getElementById('gift_card_denomination_input');
		var priceDisplay = document.getElementById('gift-card-active-price');

		if (!denomButtons.length || !denomInput) return;

		denomButtons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				denomButtons.forEach(function (b) { b.classList.remove('is-active'); });
				btn.classList.add('is-active');
				var amount = btn.getAttribute('data-amount');
				denomInput.value = amount;
				if (priceDisplay) {
					var formatted = Number(amount).toLocaleString('en-IN');
					priceDisplay.innerHTML = 'MRP <span class="amount"><bdi><span class="woocommerce-Price-currencySymbol">&#8377;</span>' + formatted + '</bdi></span>';
				}
			});
		});
	}

	/**
	 * 17. Store Locator City Filter Tabs
	 */
	function initStoreLocatorTabs() {
		var tabs = document.querySelectorAll('.store-filter-tabs .store-tab');
		var storeCards = document.querySelectorAll('.store-cards-list .store-item-card');

		if (!tabs.length || !storeCards.length) return;

		tabs.forEach(function (tab) {
			tab.addEventListener('click', function () {
				tabs.forEach(function (t) {
					t.classList.remove('is-active');
					t.setAttribute('aria-selected', 'false');
				});
				tab.classList.add('is-active');
				tab.setAttribute('aria-selected', 'true');

				var filter = tab.getAttribute('data-filter');

				storeCards.forEach(function (card) {
					var city = card.getAttribute('data-city');
					if (filter === 'all' || city === filter) {
						card.style.display = '';
					} else {
						card.style.display = 'none';
					}
				});
			});
		});
	}

	/**
	 * 18. Stage 5 Enquiry & Contact Forms AJAX Handler
	 */
	function initStage5Forms() {
		var forms = [
			{ id: 'manam-contact-form' },
			{ id: 'manam-corporate-form' },
			{ id: 'manam-professionals-form' }
		];

		var ajaxUrl = (window.manamSettings && window.manamSettings.ajaxUrl) ? window.manamSettings.ajaxUrl : '/wp-admin/admin-ajax.php';

		forms.forEach(function (cfg) {
			var form = document.getElementById(cfg.id);
			if (!form) return;

			var feedback = form.querySelector('.form-feedback-alert');
			if (!feedback) {
				feedback = document.createElement('div');
				feedback.className = 'form-feedback-alert';
				feedback.style.display = 'none';
				form.appendChild(feedback);
			}

			var submitBtn = form.querySelector('button[type="submit"]');

			form.addEventListener('submit', function (e) {
				e.preventDefault();

				if (!form.checkValidity()) {
					form.reportValidity();
					return;
				}

				if (submitBtn) {
					submitBtn.disabled = true;
					submitBtn.classList.add('is-loading');
				}

				var formData = new FormData(form);

				fetch(ajaxUrl, {
					method: 'POST',
					body: formData
				})
				.then(function (res) { return res.json(); })
				.then(function (data) {
					if (submitBtn) {
						submitBtn.disabled = false;
						submitBtn.classList.remove('is-loading');
					}

					if (data && data.success) {
						feedback.className = 'form-feedback-alert is-success';
						feedback.textContent = data.data && data.data.message ? data.data.message : 'Thank you! Your submission has been received.';
						feedback.style.display = 'block';
						form.reset();
					} else {
						feedback.className = 'form-feedback-alert is-error';
						feedback.textContent = data && data.data && data.data.message ? data.data.message : 'An error occurred. Please check your entries and try again.';
						feedback.style.display = 'block';
					}
				})
				.catch(function (err) {
					console.error('Form submission error:', err);
					if (submitBtn) {
						submitBtn.disabled = false;
						submitBtn.classList.remove('is-loading');
					}
					feedback.className = 'form-feedback-alert is-error';
					feedback.textContent = 'Unable to send details at this time. Please try again or reach out directly.';
					feedback.style.display = 'block';
				});
			});
		});
	}

	/**
	 * 19. About Us Editorial Carousels (Auto-play, Prev/Next, Touch Swipe)
	 */
	function initAboutUsCarousels() {
		var wrappers = document.querySelectorAll('.about-carousel-wrapper');
		if (!wrappers.length) return;

		wrappers.forEach(function (wrapper) {
			var track = wrapper.querySelector('.about-carousel-track');
			var slides = wrapper.querySelectorAll('.about-carousel-slide');
			var prevBtn = wrapper.querySelector('.arrow-prev');
			var nextBtn = wrapper.querySelector('.arrow-next');

			if (!slides.length) return;

			var currentIndex = 0;
			var slideCount = slides.length;
			var intervalTime = parseInt(wrapper.getAttribute('data-autoplay'), 10) || 5000;
			var timer = null;

			function goToSlide(index) {
				if (index < 0) {
					currentIndex = slideCount - 1;
				} else if (index >= slideCount) {
					currentIndex = 0;
				} else {
					currentIndex = index;
				}

				if (track) {
					track.style.transform = 'translateX(-' + (currentIndex * 100) + '%)';
				}

				slides.forEach(function (slide, idx) {
					if (idx === currentIndex) {
						slide.classList.add('active');
					} else {
						slide.classList.remove('active');
					}
				});
			}

			function nextSlide() {
				goToSlide(currentIndex + 1);
			}

			function prevSlide() {
				goToSlide(currentIndex - 1);
			}

			function startAutoplay() {
				stopAutoplay();
				timer = setInterval(nextSlide, intervalTime);
			}

			function stopAutoplay() {
				if (timer) {
					clearInterval(timer);
					timer = null;
				}
			}

			if (prevBtn) {
				prevBtn.addEventListener('click', function (e) {
					e.preventDefault();
					prevSlide();
					startAutoplay();
				});
			}

			if (nextBtn) {
				nextBtn.addEventListener('click', function (e) {
					e.preventDefault();
					nextSlide();
					startAutoplay();
				});
			}

			// Pause on hover
			wrapper.addEventListener('mouseenter', stopAutoplay);
			wrapper.addEventListener('mouseleave', startAutoplay);

			// Touch drag / swipe support
			var touchStartX = 0;
			var touchEndX = 0;

			wrapper.addEventListener('touchstart', function (e) {
				stopAutoplay();
				touchStartX = e.changedTouches[0].screenX;
			}, { passive: true });

			wrapper.addEventListener('touchend', function (e) {
				touchEndX = e.changedTouches[0].screenX;
				var diffX = touchEndX - touchStartX;
				if (Math.abs(diffX) > 40) {
					if (diffX < 0) {
						nextSlide();
					} else {
						prevSlide();
					}
				}
				startAutoplay();
			}, { passive: true });

			// Initial setup
			goToSlide(0);
			startAutoplay();
		});
	}
})();
