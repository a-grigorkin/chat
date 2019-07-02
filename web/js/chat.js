var chat = document.getElementById("chat");

var userId = '1'; // to be changed...
var messageId = -1;

var messages = [];

function parseUpdates(chat) {
	if (chat.messages.length > 0) {
		messageId = chat.messages[chat.messages.length - 1].id;

		chat.messages.forEach(function(message) {
			this.messages.push(message.time + " " + message.name + ": " + message.text);
		});
	}
}

function getUpdates() {
	var ajax = new XMLHttpRequest();

	ajax.overrideMimeType("application/json");

	ajax.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			parseUpdates(JSON.parse(this.responseText));
		}
	};

	ajax.open("GET", "chat/get/" + userId + "/" + messageId, true);
	ajax.send();
}

function sendMessage(message) {
	if (message.length > 0)
	{
		var ajax = new XMLHttpRequest();

		ajax.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				// parseUpdates(JSON.parse(this.responseText));
			}
		};

		ajax.open("POST", "chat/send/" + userId, true);
		ajax.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("name=Henry&message=" + message); // to be changed...
	}
}

/**
 * Prints the message to the chat.
 *
 * @param message
 */
function printNextLine(message) {
	var div = document.createElement("div");

	chat.appendChild(div);

	div.textContent = message;
}

function submitMessage(event) {
	var inputMessage = document.getElementById("inputMessage");

	sendMessage(inputMessage.value);

	inputMessage.value = "";

	inputMessage.focus();

	event.preventDefault();
}

document.getElementById("buttonSend").addEventListener("click", submitMessage);
document.getElementById("form").addEventListener("submit", submitMessage);

window.setInterval(function() {
	if (messages.length > 0) {
		let scrollToBottom = (chat.scrollTop + chat.clientHeight) === chat.scrollHeight;

		printNextLine(messages.shift());

		if (scrollToBottom) {
			chat.scrollTop = chat.scrollHeight;
		}
	}
}, 150);

window.setInterval(function() {
	getUpdates();
}, 500);