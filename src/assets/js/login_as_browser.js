'use strict';
(function(){

	var profileName = null;
	var profilePasswd = null;
    var jq = jQuery;

	// pure functions

	Array.prototype.at = function(index) {
    	return this[index];
	};

	function nodeListToArray(nodeList) {
		return [].map.call(nodeList, function(node, i) {
			return node;
		});
	}

	function parentFrom(el, parentTagName) {
		if (el.parentElement.tagName.toLowerCase() === parentTagName) {
			return el.parentElement;
		}
		return parentFrom(el.parentElement, parentTagName);
	}

	function firefoxLoginButton() {
		var btn = document.createElement('button');
		var spanBadge = document.createElement('span');
		btn.innerHTML = 'Firefox Login&nbsp;';
		btn.className = 'btn btn-secondary';
		btn.style.width = '160px';
		btn.type = 'button';
		btn.onclick = firefoxLoginHandler;
		spanBadge.className = 'badge badge-primary';
		spanBadge.innerHTML = 'new';
		btn.appendChild(spanBadge);
		return btn;
	}

	// impure functions

	function firefoxLoginHandler(ev) {
		var tr = parentFrom(ev.target, 'tr');
		var tds = tr.getElementsByTagName('td');
		var clientDataTd = nodeListToArray(tds).at(1);
		var text = clientDataTd.innerText;
		profileName = text.match(/Profile\: (.*)\n/).at(1);
		profilePasswd = text.match(/Password\: (.*)\n/).at(1);
		// console.log(profileName + ':' + profilePasswd);
        var url = location.pathname.match(/(.*index.php)(.*)/).at(1) +
            '/login/browser';
        jq.ajax({
        	url: url,
        	data: {
        		user: profileName,
            	pass: profilePasswd
        	}),
		    contentType : 'application/json',
		    type : 'POST'
        }, function(resp) {
        	// replace current cookies with these cookies...
            console.log(resp);
        }).fail(function() {
            console.error(arguments);
        });
		console.log(profileName + ':' + profilePasswd);
	}

	function disable(btn) {
		var cls = btn.getAttribute('class').split(' ');
		cls.push('disabled');
		btn.setAttribute('class', cls.join(' '));
		btn.setAttribute('disabled', true);
	}
	
	function enable(btn) {
		var cls = btn.getAttribute('class').split(' ');
		var className = cls.filter(function(c) { return c !== 'disabled'; }).join(' ');
		btn.setAttribute('disabled', false);
		btn.setAttribute('class', className);
	}
	
	function addButtons() {
		var rightButtons = document.querySelectorAll('.btn-success.ladda-button');
	
		// tomado de https://clubmate.fi/the-intuitive-and-powerful-foreach-loop-in-javascript/
		var lastBtns = [].filter.call(rightButtons, function(el, i) {
	    	return el.getAttribute('class').indexOf('clean-cookies') !== -1;
		});
		
		lastBtns.forEach(function(lastBtn) {
			var parent = lastBtn.parentElement;
			parent.appendChild(firefoxLoginButton());
		});
	}

	addButtons();

})();