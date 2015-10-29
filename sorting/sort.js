$(function() {
	var mgrs = {};
	var algs = {};

	function Bar (mgr, ivalue, ipos, maxvalue) {
		var e = $("<div>");
		this.elem = e;
		this.value = ivalue;
		this.pos = ipos;
		this.animating = false;

		this.cmp = function (that) {
			return this.value - that.value;
		}

		this.swap = function (that, delay) {
			var tp = this.pos;
			this.move(that.pos, delay);
			that.move(tp, delay);
		}

		var left = function (pos) {
			return (100 * pos / maxvalue) + '%'; //10 + 22 * pos;
		}

		this.move = function (p, delay) {
			this.pos = p;
			if (this.animating) {
				$(e).animate({'left': left(this.pos)}, delay,
				             'easeOutExpo');
			} else {
				$(e).css({'left': left(this.pos)});
			}
		}

		this.fast = function (fast) {
			this.animating = !fast;
		}

		this.setval = function (v) {
			this.value = v;
			$(this.elem).height(380 * (this.value / maxvalue));
		}

		this.setClass = function (m, c) {
			if (m) {
				$(e).addClass(c);
			} else {
				$(e).removeClass(c);
			}
		}

		this.mark = function (m) {
			this.setClass(m, 'marked');
		}

		this.done = function (m) {
			this.setClass(m, 'done');
		}

		this.fast(true);
		$(e).addClass("bar");
		$(e).width((60 / mgr.nbars) + '%');
		this.setval(this.value);
		this.move(this.pos);
		this.fast(false);
	}

	function Marker (mgr, maxvalue) {
		var e = $("<div>");
		this.elem = e;
		this.marker = $("<div>");
		this.pos = 0;

		var left = function (pos) {
			return (100 * pos / maxvalue) + '%';
		}

		this.move = function (p) {
			this.pos = p;
			$(e).css({'left': left(this.pos)});
		}

		this.show = function (sh, cls) {
			this.marker.removeClass();
			this.marker.addClass(cls);
			if (sh)
				$(e).show();
			else
				$(e).hide();
		}

		$(e).addClass("marker");
		$(e).append(this.marker);
		$(e).width((100 / mgr.nbars) + '%');
		this.show(false, 'line');
		this.move(this.pos);
	}

	function BarMgr (container) {
		this.bars = []
		this.mkrs = []
		this.nbars = 40;

		this.cmp = function (a, b) {
			return this.bars[a].cmp(this.bars[b]);
		}

		this.swap = function (a, b, delay) {
			var p = this.bars[a];
			var q = this.bars[b];
			if (a == b)
				return;
			p.swap(q, delay);
			this.bars[a] = q;
			this.bars[b] = p;
		}

		this.allbars = function (cb) {
			_.each(this.bars, function (bar, i, list) {
				cb(bar);
			});
		}

		this.shuffle = function () {
			this.allbars(function (bar) { bar.fast(true); });
			for (var i=0; i<3*this.nbars; i++) {
				var a = (Math.random() * this.nbars) | 0;
				var b = (Math.random() * this.nbars) | 0;
				this.swap(a, b, 0);
			}
			this.allbars(function (bar) { bar.fast(false); });
		}

		this.getvals = function () {
			return _.map(this.bars, function (bar, i, list) {
				return bar.value;
			});
		}

		this.setvals = function (s) {
			_.each(_.zip(this.bars, s), function (x, i, list) {
				x[0].setval(x[1]);
			});
		}

		for (var i=0; i<this.nbars; i++) {
			var b = new Bar(this, 1+i, i, this.nbars);
			this.bars.push(b);
			$(container).append(b.elem);
		}

		for (var i=0; i<5; i++) {
			var m = new Marker(this, this.nbars);
			this.mkrs.push(m);
			$(container).append(m.elem);
		}

		$(container).height(450);
	}

	function Algorithm (mgr, alg) {
		this.at = function (a) {
			return this.values[a];
		}

		this.len = function () {
			return this.values.length;
		}

		this.vswap = function (a, b) {
			var t = this.values[a];
			this.values[a] = this.values[b];
			this.values[b] = t;
		}

		this.cmp = function (a, b) {
			this.steps.push(['c', a, b]);
			return this.values[a] - this.values[b];
		}

		this.swap = function (a, b) {
			this.vswap(a, b);
			this.steps.push(['s', a, b]);
		}

		/* a hack created for merge sort to work with in-place
		   arrays. it should be noted that although the in-place
		   version works by repeated swaps, if the list backend is
		   linked lists, shift can be done very fast */
		this.shift = function (a, b) {
			this.steps.push(['<', a, b]);
			for (; b > a; b--)
				this.vswap(b - 1, b);
		}

		this.mkron = function (m, cls) {
			this.steps.push([':', m, cls]);
		}

		this.mkroff = function (m) {
			this.steps.push(['.', m, 'line']);
		}

		this.mkr = function (m, p) {
			this.steps.push(['m', m, p]);
		}

		this.mark = function (a) {
			this.steps.push(['*', a]);
		}

		this.unmark = function (a) {
			this.steps.push(['-', a]);
		}

		this.done = function (a, b, m) {
			this.steps.push(['!', a, b, m]);
		}

		this.run = function () {
			this.start = mgr.getvals();
			this.steps = []

			this.values = this.start.concat([])
			alg(this);

			this.end = this.values.concat([])
		}

		/* control */

		this.clrmarks = function () {
			_.each(mgr.mkrs, function (e, i, l) {
				e.show(false, 'line');
			});
			_.each(mgr.bars, function (e, i, l) {
				e.mark(false);
			});
		}

		this.rewind = function () {
			this.stepno = 0;
			mgr.setvals(this.start);
			this.clrmarks();
		}

		this.step = function (delay) {
			var step, free;

			if (this.stepno >= this.steps.length) {
				this.clrmarks();
				return false;
			}

			step = this.steps[this.stepno++];

			switch (step[0]) {
			case 'c':
				/* ignore 'c' */
				break;

			case ':':
			case '.':
				mgr.mkrs[step[1]].show(step[0] == ':', step[2]);
				break;

			case '*':
			case '-':
				mgr.bars[step[1]].mark(step[0] == '*');
				break;

			case '!':
				for (var i=step[1]; i<step[2]; i++)
					mgr.bars[i].done(step[3]);
				break;

			case 'm':
				mgr.mkrs[step[1]].move(step[2]);
				break;

			case 's':
				mgr.swap(step[1], step[2], delay);
				break;

			case '<':
				var a = step[1];
				var b = step[2];
				mgr.bars[b].fast(true);
				for (; b > a; b--)
					mgr.swap(b - 1, b, delay);
				mgr.bars[a].fast(false);
				break;
			}

			if ("s<".indexOf(step[0]) < 0)
				return this.step(delay);

			return true;
		}
	}

	function Control (alg, container) {
		var panel = $("<div>");

		$(panel).addClass("control");
		$(container).append(panel);

		function button(text, onClick) {
			var btn = $("<button>");
			$(btn).text(text);
			$(btn).click(onClick);
			$(panel).append(btn);
			return btn;
		}

		/*
		button('Start', function(e) {
			alert('Starting!');
		});

		button('Stop', function(e) {
			alert('Stopping!');
		});
		*/

		var timer = undefined;
		var del = 400;
		function onestep() {
			if (alg.step(del / 1.3))
				timer = setTimeout(onestep, del);
		}

		this.btn_play = button('Sort!', function(e) {
			if (timer !== undefined)
				clearTimeout(timer);
			alg.rewind();
			timer = setTimeout(onestep, 10);
		});

		this.delay_up = button('Faster', function(e) {
			del /= 1.4;
		});
		this.delay_dn = button('Slower', function(e) {
			del *= 1.4;
		});
	}

	$(".sort").each(function(x) {
		var id = $(this).attr('id');
		var ctr = $("<div>");
		$(ctr).addClass("bars");
		var mgr = new BarMgr(ctr);
		$(this).append(ctr);
		mgr.shuffle();
		mgrs[id] = mgr;
	});

	function algorithm (name, alg) {
		algs[name] = new Algorithm(mgrs[name], alg);
		new Control(algs[name], $('#'+name));
	}

	algorithm('quick', function (A) {
		A.mkron(0, 'line');
		A.mkron(1, 'line');
		A.mkron(2, 'sep');
		A.mkron(3, 'sep');

		function qs(start, end) {
			var i, mid;

			A.mkr(0, start + 1);
			A.mkr(1, end);

			if (end - start < 2) {
				A.done(start, end, true);
				return;
			}

			A.mark(start);
			mid = end;
			for (i = start + 1; i < mid; ) {
				A.mkr(2, i);
				A.mkr(3, mid);
				if (A.cmp(i, start) > 0) {
					A.swap(i, --mid);
				} else {
					i++;
				}
			}
			A.unmark(start);
			A.swap(start, mid - 1);

			qs(start, mid - 1);
			qs(mid, end);
			A.done(start, end, true);
		}

		qs(0, A.len());
	});

	algorithm('merge', function (A) {
		A.mkron(0, 'line');
		A.mkron(1, 'line');
		A.mkron(2, 'sep');

		function merge (A, i, j, end) {
			A.mkr(0, i);
			A.mkr(1, end);

			for (; i < end; i++) {
				A.mkr(2, j + 1);
				if (A.cmp(i, j) > 0 && j < end)
					A.shift(i, j++);
			}
		}

		function ms (A, start, end) {
			var mid = Math.floor((start + end) / 2);

			if (end - start < 2)
				return;

			ms(A, start, mid);
			ms(A, mid, end);

			A.done(start, end, false);
			merge(A, start, mid, end);
			A.done(start, end, true);
		}

		A.done(0, A.len(), true);
		ms(A, 0, A.len());
	});

	algorithm('insert', function (A) {
		var i, j;

		A.mkron(0, 'line');

		for (i = 1; i < A.len(); i++) {
			A.mark(i);
			A.mkr(0, i);
			for (j = i; j > 0; j--) {
				if (A.cmp(j - 1, j) > 0)
					A.swap(j - 1, j);
				else
					break;
			}
			A.unmark(j);
			A.done(0, i, true);
		}

		A.done(0, A.len(), true);
	});

	algorithm('heap', function (A) {
		function heapify(i, end) {
			var l = 2*i + 1;
			var r = l + 1;

			largest = i;

			if (l < end && A.cmp(l, largest) > 0)
				largest = l;
			if (r < end && A.cmp(r, largest) > 0)
				largest = r;

			if (largest == i) {
				A.unmark(i);
				return;
			}

			A.mark(largest);
			A.swap(i, largest);
			A.unmark(i);
			heapify(largest, end);
		}

		for (var i = A.len() / 2 - 1; i >= 0; i--)
			heapify(i, A.len());

		A.mkron(0, 'sep');
		for (var i = A.len() - 1; i > 0; i--) {
			A.mkr(0, i);
			A.swap(0, i);
			A.done(i, A.len(), true);
			heapify(0, i);
		}

		A.done(0, A.len(), true);
	});

	algs['quick'].run();
	algs['merge'].run();
	algs['insert'].run();
	algs['heap'].run();
});