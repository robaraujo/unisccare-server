function ChatViewModel(data){
		
    var self = this;
    // user list
    this.users = ko.observableArray([]);
    // user selected
    this.slUser = ko.mapping.fromJS({id: 0, first_name: '', last_name: '', picture: ''});
    // msgs list
    this.messages = ko.observableArray([]);
    // message text input
    this.msgToSend = ko.observable();
    // user search query
    this.searchQuery = ko.observable();

    /**
     * Select user chat
     */
    this.selectUser = function(user) {
        ko.mapping.fromJS(user, this.slUser);
        this.messages([]);

        // show loader and get user chat
        loaderPresent();
        this.getChat(function(status) {
            loaderDismiss();
            scrollBottom('.container-msgs', 0);
        });
    };
    
    /**
     * Send message to server
     */
    this.sendMsg = function() {
        // only send if its not empty
        var text = $.trim(self.msgToSend());
        if (!text) return false;
        
        var msg = {
            id: getLastId(self.messages())+1,
            user_id: self.slUser.id(),
            content: text,
            from: 'staff',
            automatic: false,
            sending: true,
            created_at: moment().format('YYYY-MM-DD HH:mm:ss')
        };

        // add message after server confirmation, with sending flag
        self.messages.push(msg);
        self.msgToSend('');
        scrollBottom('.container-msgs');

        $.ajax({
            dataType: "json",
            url: CONFIG.url+'/staff/msg/store',
            data: msg,
            success: function(new_msg) {
                // replace temp message with server response
                self.messages.replace(msg, new_msg);
                self.updateSlUserLastMessage(new_msg);
            }
        });
    };

    /**
     * Get users and hist last msg
     */
    this.getUsers = function(callback) {
        $.getJSON(CONFIG.url+'/staff/msg/users', function(data) {
            self.users( data );

            if (callback) callback();
        });
    }

    /**
     * Get selected chat message
     */
    this.getChat = function(callback) {
        
        var user_id = this.slUser.id();
        var msgs = this.messages();
        if (!user_id) return;

        $.ajax({
            dataType: "json",
            url: CONFIG.url+'/staff/msg/list',
            data: {
                user_id: user_id,
                last_msg: getLastId(msgs),
            },
            success: function(messages) {
                
                // if empty messages or user changed
                if (messages.length && user_id === self.slUser.id()) {
                    
                    // prevent duplicate messages
                    var lastId = getLastId(msgs);
                    messages.map(function(msg) {
                        if (msg.id > lastId) {
                            self.messages.push(msg);        
                        }
                    });    
                }

                if (callback) callback();
            }
        });
    }
    
    // helper functions
    /**
     * Get user or staff picture path
     * @param User $user
     * @param string $folder
     *
     * @return string
     */
    this.getPicture = function(picture, folder) {
        let pic = picture || 'empty.png';
        return CONFIG.url+'/img/'+folder+'/'+pic;
    };

    this.getMessageClass = function(message) {
        return {
            'message'   : true,
            'pull-left' : message.from === 'user' && !message.automatic,
            'center'    : message.from === 'user' && message.automatic,
            'pull-right': message.from === 'staff',
        }
    }

    /**
     * Replace user selected last msg, iterating users and find by id
     * Obs.: Maintain just a selected reference can cause error if this.users update
     */
    this.updateSlUserLastMessage = function(msg) {
        var users = this.users();
        for (var i=0; i<users.length; i++) {
            var user = jQuery.extend(true, {}, users[i]);

            if (user.id === this.slUser.id()) {
                user.last_msg = msg;
                this.users.replace(users[i], user);
                break;
            }
        }
    }

    /**
     * Filter users by input in searchQuery
     */
    this.filteredEntries = ko.computed(function() {
        if(!this.searchQuery()) {
            return this.users();
        }
        
        return ko.utils.arrayFilter(this.users(), function(item) {
            var name = (item.first_name+item.last_name).toLowerCase();
            var filter = self.searchQuery().toLowerCase();
            return name.indexOf(filter) !== -1;
        });
    }, this);

    // chat ready
    this.getUsers(function() {
        loaderDismiss()
        $('#chat').show();
    });

    // start pollings
    setInterval(this.getChat.bind(this), 3000);
    setInterval(this.getUsers.bind(this), 10000);
}

loaderPresent(true);
var chatApp = new ChatViewModel();
ko.applyBindings(chatApp, document.getElementById('chat'));