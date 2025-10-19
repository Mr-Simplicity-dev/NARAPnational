/**
 * Custom Dropdown Handler for NARAP Admin Dashboard
 * Handles navigation dropdowns and prevents Bootstrap conflicts
 */

class DropdownManager {
    constructor() {
        this.dropdowns = new Map();
        this.activeDropdown = null;
        this.init();
    }

    init() {
        console.log('🟢 Initializing Custom Dropdown Manager...');
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupDropdowns());
        } else {
            this.setupDropdowns();
        }
    }

    setupDropdowns() {
        try {
            // Find all dropdown toggles
            const dropdownToggles = document.querySelectorAll('[data-bs-toggle="dropdown"], .dropdown-toggle');
            
            console.log(`Found ${dropdownToggles.length} dropdown toggles`);

            dropdownToggles.forEach((toggle, index) => {
                this.initializeDropdown(toggle, index);
            });

            // Setup global click handler
            this.setupGlobalHandlers();
            
            console.log('✅ Dropdown Manager initialized successfully');
        } catch (error) {
            console.error('❌ Error initializing dropdowns:', error);
        }
    }

    initializeDropdown(toggle, index) {
        if (!toggle) return;

        const dropdownId = `dropdown-${index}`;
        const parentItem = toggle.closest('.nav-item');
        const dropdownMenu = parentItem ? parentItem.querySelector('.nav-dropdown, .dropdown-menu') : null;

        if (!parentItem) {
            console.warn('No parent nav-item found for dropdown toggle:', toggle);
            return;
        }

        // Store dropdown data
        this.dropdowns.set(dropdownId, {
            toggle,
            menu: dropdownMenu,
            parent: parentItem,
            isOpen: false
        });

        // Add click handler
        toggle.addEventListener('click', (e) => this.handleToggleClick(e, dropdownId));
        
        // Add keyboard handler
        toggle.addEventListener('keydown', (e) => this.handleKeydown(e, dropdownId));

        // Setup dropdown items if they exist
        if (dropdownMenu) {
            const dropdownItems = dropdownMenu.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('click', (e) => this.handleItemClick(e, dropdownId));
            });
        }

        console.log(`✅ Initialized dropdown: ${dropdownId}`);
    }

    handleToggleClick(event, dropdownId) {
        event.preventDefault();
        event.stopPropagation();

        const dropdown = this.dropdowns.get(dropdownId);
        if (!dropdown) return;

        // Close other dropdowns first
        this.closeAllDropdowns(dropdownId);

        // Toggle current dropdown
        if (dropdown.isOpen) {
            this.closeDropdown(dropdownId);
        } else {
            this.openDropdown(dropdownId);
        }
    }

    handleItemClick(event, dropdownId) {
        const item = event.target.closest('.dropdown-item');
        if (!item) return;

        // Get the target from data-target attribute
        const target = item.getAttribute('data-target');
        
        if (target) {
            event.preventDefault();
            
            // Update active states
            this.updateActiveStates(item);
            
            // Close dropdown
            this.closeDropdown(dropdownId);
            
            // Trigger custom event for the target
            this.triggerTargetEvent(target, item);
        }
    }

    handleKeydown(event, dropdownId) {
        const dropdown = this.dropdowns.get(dropdownId);
        if (!dropdown) return;

        switch (event.key) {
            case 'Enter':
            case ' ':
                event.preventDefault();
                this.handleToggleClick(event, dropdownId);
                break;
            case 'Escape':
                if (dropdown.isOpen) {
                    this.closeDropdown(dropdownId);
                    dropdown.toggle.focus();
                }
                break;
            case 'ArrowDown':
                if (dropdown.isOpen && dropdown.menu) {
                    event.preventDefault();
                    const firstItem = dropdown.menu.querySelector('.dropdown-item');
                    if (firstItem) firstItem.focus();
                }
                break;
        }
    }

    openDropdown(dropdownId) {
        const dropdown = this.dropdowns.get(dropdownId);
        if (!dropdown || dropdown.isOpen) return;

        // Update state
        dropdown.isOpen = true;
        this.activeDropdown = dropdownId;

        // Update DOM
        dropdown.toggle.setAttribute('aria-expanded', 'true');
        dropdown.parent.classList.add('show');
        
        if (dropdown.menu) {
            dropdown.menu.classList.add('show');
            dropdown.menu.style.display = 'block';
        }

        // Rotate chevron if it exists
        const chevron = dropdown.toggle.querySelector('.fa-chevron-right');
        if (chevron) {
            chevron.style.transform = 'rotate(90deg)';
        }

        console.log(`📂 Opened dropdown: ${dropdownId}`);
    }

    closeDropdown(dropdownId) {
        const dropdown = this.dropdowns.get(dropdownId);
        if (!dropdown || !dropdown.isOpen) return;

        // Update state
        dropdown.isOpen = false;
        if (this.activeDropdown === dropdownId) {
            this.activeDropdown = null;
        }

        // Update DOM
        dropdown.toggle.setAttribute('aria-expanded', 'false');
        dropdown.parent.classList.remove('show');
        
        if (dropdown.menu) {
            dropdown.menu.classList.remove('show');
            dropdown.menu.style.display = 'none';
        }

        // Reset chevron if it exists
        const chevron = dropdown.toggle.querySelector('.fa-chevron-right');
        if (chevron) {
            chevron.style.transform = 'rotate(0deg)';
        }

        console.log(`📁 Closed dropdown: ${dropdownId}`);
    }

    closeAllDropdowns(exceptId = null) {
        this.dropdowns.forEach((dropdown, id) => {
            if (id !== exceptId && dropdown.isOpen) {
                this.closeDropdown(id);
            }
        });
    }

    updateActiveStates(clickedItem) {
        // Remove active class from all nav links and dropdown items
        document.querySelectorAll('.nav-link').forEach(nav => nav.classList.remove('active'));
        document.querySelectorAll('.dropdown-item').forEach(item => item.classList.remove('active'));
        
        // Add active class to clicked item
        clickedItem.classList.add('active');
        
        // Add active class to parent nav link
        const parentToggle = clickedItem.closest('.nav-item')?.querySelector('.nav-link');
        if (parentToggle) {
            parentToggle.classList.add('active');
        }
    }

    triggerTargetEvent(target, item) {
        // Dispatch custom event
        const event = new CustomEvent('dropdownItemSelected', {
            detail: {
                target,
                item,
                text: item.textContent.trim()
            }
        });
        
        document.dispatchEvent(event);
        
        console.log(`🎯 Triggered target: ${target}`);
    }

    setupGlobalHandlers() {
        // Close dropdowns when clicking outside
        document.addEventListener('click', (event) => {
            const isDropdownClick = event.target.closest('.nav-item, .dropdown');
            if (!isDropdownClick) {
                this.closeAllDropdowns();
            }
        });

        // Close dropdowns on escape key
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                this.closeAllDropdowns();
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            this.closeAllDropdowns();
        });
    }

    // Public methods for external use
    getActiveDropdown() {
        return this.activeDropdown;
    }

    isDropdownOpen(dropdownId) {
        const dropdown = this.dropdowns.get(dropdownId);
        return dropdown ? dropdown.isOpen : false;
    }

    forceCloseAll() {
        this.closeAllDropdowns();
    }
}

// Initialize dropdown manager
let dropdownManager;

// Safe initialization
function initDropdowns() {
    try {
        if (!dropdownManager) {
            dropdownManager = new DropdownManager();
        }
    } catch (error) {
        console.error('Failed to initialize dropdown manager:', error);
    }
}

// Auto-initialize
if (typeof window !== 'undefined') {
    initDropdowns();
}

// Export for external use
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { DropdownManager, dropdownManager };
} else if (typeof window !== 'undefined') {
    window.DropdownManager = DropdownManager;
    window.dropdownManager = dropdownManager;
}

// Listen for dropdown item selections (for integration with your admin.js)
document.addEventListener('dropdownItemSelected', function(event) {
    const { target, item, text } = event.detail;
    
    // You can handle specific targets here or let admin.js handle them
    console.log(`Dropdown item selected: ${text} (target: ${target})`);
    
    // Example: trigger existing admin.js functions
    if (typeof window.showSection === 'function') {
        window.showSection(target);
    }
});

console.log('🟢 Dropdown.js loaded successfully');