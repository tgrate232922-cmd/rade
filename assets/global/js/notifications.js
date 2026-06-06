// Mark single notification as read
function markAsRead(event, notificationId) {
    event.preventDefault();
    event.stopPropagation();
    
    fetch(`/user/notification/mark-read/${notificationId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI
            const listItem = document.querySelector(`li[data-notification-id="${notificationId}"]`);
            if (listItem) {
                listItem.classList.remove('notification-unread');
                listItem.classList.add('notification-read');
                
                // Remove mark as read button
                const markBtn = listItem.querySelector('.mark-read-btn');
                if (markBtn) markBtn.remove();
            }
            
            // Update counter
            updateNotificationCount();
            
            // Show toast/message
            showToast('Notification marked as read');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Failed to mark notification as read', 'error');
    });
}

// Mark all notifications as read
function markAllAsRead(event) {
    event.preventDefault();
    event.stopPropagation();
    
    fetch('/user/notification/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update all notifications UI
            document.querySelectorAll('.notification-unread').forEach(item => {
                item.classList.remove('notification-unread');
                item.classList.add('notification-read');
            });
            
            // Remove all mark as read buttons
            document.querySelectorAll('.mark-read-btn').forEach(btn => btn.remove());
            
            // Hide mark all button
            const markAllBtn = document.querySelector('.mark-all-read-btn');
            if (markAllBtn) markAllBtn.style.display = 'none';
            
            // Update counter to 0
            const badge = document.getElementById('notificationCount');
            if (badge) badge.style.display = 'none';
            
            const dropBtn = document.querySelector('.notifications-drop-btn');
            if (dropBtn) dropBtn.classList.remove('has-notification');
            
            // Show toast
            showToast('All notifications marked as read');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Failed to mark all as read', 'error');
    });
}

// Update notification count
function updateNotificationCount() {
    const unreadCount = document.querySelectorAll('.notification-unread').length;
    const badge = document.getElementById('notificationCount');
    const dropBtn = document.querySelector('.notifications-drop-btn');
    
    if (unreadCount === 0) {
        if (badge) badge.style.display = 'none';
        if (dropBtn) dropBtn.classList.remove('has-notification');
        
        // Hide mark all button
        const markAllBtn = document.querySelector('.mark-all-read-btn');
        if (markAllBtn) markAllBtn.style.display = 'none';
    } else {
        if (badge) {
            badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
            badge.style.display = 'flex';
        }
    }
}

// Simple toast notification
function showToast(message, type = 'success') {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.notification-toast');
    existingToasts.forEach(t => t.remove());
    
    const toast = document.createElement('div');
    toast.className = `notification-toast toast-${type}`;
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 24px;
        right: 24px;
        background: ${type === 'success' ? 'linear-gradient(135deg, #c8ff00 0%, #00ff88 100%)' : '#ff4466'};
        color: #0a1f1c;
        padding: 14px 20px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        z-index: 10000;
        animation: slideInUp 0.3s ease;
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slideOutDown 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add CSS animation styles
if (!document.getElementById('notification-animations')) {
    const style = document.createElement('style');
    style.id = 'notification-animations';
    style.textContent = `
        @keyframes slideInUp {
            from { transform: translateY(100px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes slideOutDown {
            from { transform: translateY(0); opacity: 1; }
            to { transform: translateY(100px); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
}