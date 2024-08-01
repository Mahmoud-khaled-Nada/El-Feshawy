(function ($) {
    $(document).ready(function () {
        $(document).on("click", ".get-conversation", function () {
            const conversationId = $(this).data("conversation-id");
            $("#current_conversation_id").val(conversationId); // Store conversation ID

            if (conversationId) {
                console.log("Conversation selected, enabling send button");
                $("#message_sent_btn").prop("disabled", false);
            }

            $.ajax({
                url: `/supporter/conversation/${conversationId}`,
                method: "GET",
                data: {
                    _token: csrf_token,
                },
                success: function (data) {
                    renderConversation(data.data);
                },
                error: function (error) {
                    console.error("Error fetching conversation:", error);
                },
            });
        });

        function renderConversation(data) {
            const chatBody = $("#chat-body");
            const chatTitle = $("#chat-title");
            const chatMessages = $("#chat-messages");

            if (!chatTitle.length || !chatMessages.length) {
                console.error("Chat title or messages container not found.");
                return;
            }

            chatTitle.text(data.conversation.title);
            chatMessages.empty();
            let employeeImage = data.conversation.employee.image ?? false;

            if (data.messages && data.messages.length > 0) {
                data.messages.forEach((message) => {
                    let isSender = message.sender.id === authenticatedUserId;
                    let messageHtml = `
                        <div class="d-flex ${isSender ? "justify-content-end" : "justify-content-start"} mb-10">
                            <div class="d-flex flex-column align-items-${isSender ? "end" : "start"}">
                                <div class="d-flex align-items-center mb-2 ${isSender ? "flex-row-reverse" : ""}">
                                    <div class="symbol symbol-35px symbol-circle">
                                        ${!isSender && employeeImage ? `<img alt="Pic" src="${employeeImage}">` : `
                                            <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">
                                                ${message.sender.name[0]}
                                            </span>`}
                                    </div>
                                    <div class="${isSender ? "me-3 text-end" : "ms-3 text-start"}">
                                        ${isSender ? `
                                            <span class="text-muted fs-7 mb-1">${new Date(message.created_at).toLocaleTimeString()}</span>
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">You</a>` : `
                                            <a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary">${message.sender.name}</a>
                                            <span class="text-muted fs-7 mb-1">${new Date(message.created_at).toLocaleTimeString()}</span>`}
                                    </div>
                                </div>
                                <div class="p-5 rounded ${isSender ? "bg-light-primary" : "bg-light-info"} text-gray-900 fw-semibold mw-lg-400px text-${isSender ? "end" : "start"}" data-kt-element="message-text">
                                    ${message.message}
                                </div>
                            </div>
                        </div>`;
                    chatMessages.append(messageHtml);
                    chatBody.scrollTop(chatBody[0].scrollHeight);
                });
            } else {
                chatMessages.html("<p>No messages to display</p>");
            }
        }

        $(document).on("click", "#message_sent_btn", function () {
            const conversationId = $("#current_conversation_id").val();
            const messageText = $("#message_textarea").val();

            if (messageText.trim() === "" || !conversationId) {
                alert("Please select a conversation and enter a message.");
                return;
            }

            $.ajax({
                url: `/supporter/messages`,
                method: "POST",
                data: {
                    _token: csrf_token,
                    conversation_id: conversationId,
                    message: messageText,
                },
                success: function (data) {
                    $("#message_textarea").val("");
                    FormatSingleMessage(data.data);
                },
                error: function (error) {
                    console.error("Error sending message:", error);
                },
            });
        });

        function FormatSingleMessage(message) {
            const chatBody = $("#chat-body");
            const chatMessages = $("#chat-messages");
            let isSender = message.sender_id === authenticatedUserId;
            if (isSender && message) {
                let messageHtml = `
             <div class="d-flex justify-content-end mb-10">
                    <div class="d-flex flex-column align-items-end">
                        <div class="d-flex align-items-center mb-2">
                            <div class="me-3">
                                <span class="text-muted fs-7 mb-1">${new Date(message.created_at).toLocaleTimeString()}</span>
                                <a class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>
                            </div>
                            <div class="symbol symbol-35px symbol-circle">
                                    <span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">
                                ${message.sender_name[0]}
                            </span>
                            </div>
                        </div>
                        <div class="p-5 rounded bg-light-primary text-gray-900 fw-semibold mw-lg-400px text-end"
                            data-kt-element="message-text">${message.message}</div>
                    </div>
                </div>   
            `;
                chatMessages.append(messageHtml);
                chatBody.scrollTop(chatBody[0].scrollHeight);
            }
        }
    });
})(jQuery);
