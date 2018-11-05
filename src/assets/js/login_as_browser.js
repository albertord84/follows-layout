'use strict';
(function(){

    var profileId = null;
	var profileName = null;
	var profilePasswd = null;
	var profileProxy = null;
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

    function getProfileId(tdEl) {
        var text = tdEl.innerText;
        return text.match(/Dumbu ID\: (\d+)\n/).at(1);
    }

    function getProfileName(tdEl) {
        var text = tdEl.innerText;
        return text.match(/Profile\: (.*)\n/).at(1);
    }

    function getProfilePasswd(tdEl) {
		var text = tdEl.innerText;
		return text.match(/Password\: (.*)\n/).at(1);
	}

	function getProfileProxy(tdEl) {
		var text = tdEl.innerText;
		return text.match(/Proxy:\nID: (\d+)/).at(1);
	}

	function getProfileDataTableCells(fromTarget) {
        var tr = parentFrom(fromTarget, 'tr');
        var tds = tr.getElementsByTagName('td');
        return nodeListToArray(tds);
    }

	// impure functions

    function setClientData(fromBtn) {
        var clientDataTd = getProfileDataTableCells(fromBtn).at(1);
        profileId = getProfileId(clientDataTd);
        profileName = getProfileName(clientDataTd);
        profilePasswd = getProfilePasswd(clientDataTd);
    }

    function setClientProxy(fromBtn) {
        var clientProxyTd = getProfileDataTableCells(fromBtn).at(3);
        profileProxy = getProfileProxy(clientProxyTd);
    }

    function openCheckpointUrl(url) {
        window.open(url,'_blank');
    }

    function updateClientCookies(clientId, cookies) {
	    console.log('cookies will be updated soon...');
    }

	function ajaxLoginTerminated(resp) {
		var data = JSON.parse(resp);
		if (data.authenticated) {
		    updateClientCookies(profileId, data);
		    return;
        }
        openCheckpointUrl(data.checkpoint_url);
	}

	function firefoxLoginHandler(ev) {
	    var fromBtn = ev.target;
		setClientData(fromBtn);
        setClientProxy(fromBtn);
        var url = location.pathname.match(/(.*index.php)(.*)/).at(1) +
            '/login/browser';
        jq.post(url,
			{
				user: profileName,
				pass: profilePasswd,
				proxy: profileProxy
			},
	    	ajaxLoginTerminated
		).fail(function() {
    		console.log(arguments);
    	});
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