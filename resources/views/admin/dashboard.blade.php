<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIPADU Pemerintahan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/a2e0e6cfd7.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Serif:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variables for a sophisticated, governmental feel */
        :root {
            --primary-color: #2c5282; /* Deeper, rich blue */
            --primary-hover: #224269; /* Even darker for hover */
            --primary-light: #e6f0fa; /* Very light blue for subtle accents */
            --success-color: #2f855a; /* Muted, professional green */
            --danger-color: #c53030; /* Authoritative red */
            --warning-color: #d69e2e; /* Muted, stable orange */
            --info-color: #3182ce; /* Clear, reliable info blue */
            --background-gradient: #f9fafb; /* Off-white for clean background */
            --sidebar-bg: #2c5282; /* Solid primary blue for sidebar */
            --sidebar-item-hover: rgba(255, 255, 255, 0.1); /* Subtle white overlay on hover */
            --sidebar-active: #1e3a5f; /* Darkest primary for active state */
            --text-light: #ffffff; /* White text for sidebar */
            --text-muted: #e0e7ed; /* Lighter white-blue for muted text on sidebar */
            --border-color: #e2e8f0; /* Consistent light grey border */
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.06); /* Slightly more prominent, but soft shadow */
            --card-shadow-hover: 0 8px 20px rgba(0, 0, 0, 0.1); /* Enhanced on hover */
            --heading-color: #1a202c; /* Very dark grey for headings */
            --text-color: #4a5568; /* Standard body text color */
        }

        /* General Body and Layout */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--background-gradient);
            color: var(--text-color);
            line-height: 1.7; /* Slightly increased line height for readability */
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased; /* Smoother font rendering */
            -moz-osx-font-smoothing: grayscale;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Loading Overlay - Added for better UX */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            visibility: visible;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .loading-overlay.is-hidden {
            opacity: 0;
            visibility: hidden;
        }

        .spinner {
            border: 4px solid var(--primary-light);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            color: var(--text-light);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); /* Smooth width transition */
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 8px; /* Slightly wider scrollbar */
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05); /* Lighter track */
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px; /* Slightly more rounded */
        }

        .sidebar-header {
            padding: 2.2rem 1.5rem; /* More vertical padding */
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.05); /* Very subtle darker background for header */
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .sidebar-header .logo {
            width: 75px; /* Slightly larger logo */
            height: 75px;
            border-radius: 50%; /* Circular logo */
            background: var(--primary-hover);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem; /* Larger icon in logo */
            color: white;
            margin: 0 auto 1rem;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25); /* Deeper shadow for logo */
            font-weight: 600; /* Make initials bold */
        }

        .sidebar-header .title {
            font-family: 'Roboto Serif', serif; /* A more formal serif font for titles */
            color: var(--text-light);
            font-size: 1.45rem; /* Larger and more prominent title */
            font-weight: 600; /* Medium-bold */
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em; /* Tighter letter spacing */
        }

        .sidebar-header .subtitle {
            color: var(--text-muted);
            font-size: 0.95rem; /* Slightly larger subtitle */
            font-weight: 400;
        }

        .sidebar-menu {
            padding: 1.5rem 1.25rem; /* More consistent padding */
        }

        .menu-section {
            margin-bottom: 2rem;
        }

        .menu-label {
            color: var(--text-muted);
            font-size: 0.7rem; /* Slightly smaller label for hierarchy */
            font-weight: 700; /* Bold label */
            text-transform: uppercase;
            letter-spacing: 0.1em; /* More prominent letter spacing */
            margin-bottom: 0.8rem; /* More space below label */
            padding-left: 1rem;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.4rem; /* More space between menu items */
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.95rem 1.25rem; /* More generous padding */
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); /* Smoother transition */
            font-weight: 500;
            position: relative;
        }

        .sidebar-menu a:hover {
            background-color: var(--sidebar-item-hover);
            color: var(--text-light);
            transform: translateX(6px); /* More pronounced slide effect */
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* Subtle shadow on hover */
        }

        .sidebar-menu a.is-active {
            background: var(--sidebar-active);
            color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.25); /* Stronger active shadow */
            transform: translateX(4px); /* Slight initial translation for active */
        }

        .sidebar-menu a .icon {
            margin-right: 1rem; /* More space for icons */
            font-size: 1.15rem; /* Slightly larger icons */
            width: 22px; /* Fixed width for icon alignment */
            text-align: center;
        }

        .logout-section {
            padding: 1.5rem 1.25rem; /* Consistent padding */
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        /* Main Content Styling */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2.5rem; /* More generous main content padding */
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--background-gradient); /* Consistent with body background */
            position: relative; /* For scrollbar and potential overlays */
        }

        .page-header {
            background: white;
            border-radius: 14px; /* More rounded corners for cards */
            padding: 2.5rem; /* More padding */
            margin-bottom: 2.5rem; /* More spacing below header */
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 5;
            background-clip: padding-box; /* Fix for shadow on sticky element */
        }

        .page-title {
            font-family: 'Roboto Serif', serif;
            font-size: 2.4rem; /* Larger and bolder title */
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 0.75rem; /* More space below title */
        }

        .page-subtitle {
            color: var(--text-color);
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); /* Min width slightly larger */
            gap: 1.8rem; /* More gap */
            margin-bottom: 2.5rem;
        }

        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 2rem; /* More padding */
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            transition: all 0.35s ease-in-out; /* Slower, smoother transition */
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card:hover {
            transform: translateY(-5px); /* More noticeable lift */
            box-shadow: var(--card-shadow-hover);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px; /* Thicker top border */
            background: linear-gradient(90deg, var(--primary-color), var(--info-color)); /* More vibrant gradient */
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem; /* More space below header */
        }

        .stat-icon {
            width: 56px; /* Larger icon container */
            height: 56px;
            border-radius: 50%; /* Circular icons for stats */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem; /* Larger icon font */
            color: white;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15); /* More prominent shadow */
            flex-shrink: 0; /* Prevent icon from shrinking */
        }

        .stat-icon.primary { background: var(--primary-color); }
        .stat-icon.success { background: var(--success-color); }
        .stat-icon.warning { background: var(--warning-color); }
        .stat-icon.danger { background: var(--danger-color); }

        .stat-content {
            text-align: right; /* Align value and label to the right */
        }

        .stat-value {
            font-size: 2.4rem; /* Larger value */
            font-weight: 700;
            color: var(--heading-color);
            line-height: 1; /* Tighter line height */
        }

        .stat-label {
            color: var(--text-color);
            font-size: 0.95rem; /* Slightly larger label */
            font-weight: 500;
            margin-top: 0.25rem;
        }

        /* Content Card Styling */
        .content-card {
            background: white;
            border-radius: 14px;
            box-shadow: var(--card-shadow);
            margin-bottom: 2.5rem;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .card-header {
            padding: 1.8rem 2.2rem; /* More padding */
            border-bottom: 1px solid var(--border-color);
            background: #fdfdfe; /* Subtle off-white for header */
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .card-title {
            font-family: 'Roboto Serif', serif;
            font-size: 1.5rem; /* Larger title */
            font-weight: 600;
            color: var(--heading-color);
        }

        .card-subtitle {
            color: var(--text-color);
            font-size: 0.9rem;
        }

        .card-content {
            padding: 2.2rem; /* More generous padding */
        }

        .action-buttons {
            display: flex;
            gap: 1rem; /* More space between buttons */
            margin-bottom: 1.8rem; /* More space below buttons */
            flex-wrap: wrap;
        }

        /* Table Styling */
        /* Updated table-container to use the provided structure */
        .relative.overflow-x-auto.shadow-md.sm\:rounded-lg {
            overflow-x: auto;
            border-radius: 10px; /* Slightly more rounded for tables */
            border: 1px solid var(--border-color);
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.03); /* Inner shadow for tables */
        }

        .table { /* Existing Bulma table class */
            margin: 0;
            background: white;
            border-collapse: separate; /* Allows border-radius on table-container */
            border-spacing: 0;
            width: 100%; /* Ensure it fills parent */
            text-align: left; /* rtl:text-right is not directly used by Bulma */
        }

        .table.is-striped tbody tr:nth-child(even) {
            background-color: #f8f8f8; /* Bulma striped color */
        }

        .table.is-hoverable tbody tr:not(.is-selected):hover {
            background-color: #f5f5f5; /* Bulma hover color */
        }

        .table thead th {
            background: #f1f5f9;
            color: #3b4a5d; /* Darker header text */
            font-weight: 600;
            border: none;
            padding: 1.1rem 1.4rem; /* More padding */
            font-size: 0.8rem; /* Slightly smaller for compactness */
            text-transform: uppercase;
            letter-spacing: 0.06em; /* More prominent spacing */
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .table tbody td {
            padding: 1rem 1.4rem; /* Consistent padding */
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 0.92rem; /* Slightly larger body text */
            color: var(--text-color);
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 1rem; /* More generous padding */
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: capitalize; /* Capitalize first letter */
            letter-spacing: 0.02em;
            transition: all 0.2s ease;
        }

        .status-badge:hover {
            transform: translateY(-1px) scale(1.02); /* Slight lift and scale on hover */
        }

        .status-menunggu {
            background-color: #fefce8; /* Very light yellow */
            color: #a16207; /* Darker, richer orange-brown */
            border: 1px solid #fde047;
        }

        .status-diproses {
            background-color: #e0f2fe; /* Light blue */
            color: #0d619f; /* Deeper blue */
            border: 1px solid #93c5fd;
        }

        .status-selesai {
            background-color: #dcfce7; /* Light green */
            color: #1a6d4b; /* Deeper green */
            border: 1px solid #bbf7d0;
        }

        /* Button Styling */
        .button {
            font-weight: 600; /* Bolder button text */
            border-radius: 8px; /* More rounded buttons */
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.9rem; /* Slightly larger button text */
            padding-left: 1.2em; /* More padding */
            padding-right: 1.2em;
            height: 2.8em; /* Standard height */
            min-width: 80px; /* Minimum width for consistency */
            white-space: nowrap; /* Prevent text wrap */
        }

        .button .icon {
            margin-right: 0.5rem;
        }

        .button:focus:not(:active) {
            box-shadow: 0 0 0 0.125em rgba(44, 82, 130, 0.25); /* Primary color focus ring */
            outline: none;
        }

        .button.is-primary {
            background: var(--primary-color);
            border: none;
            color: white;
            box-shadow: 0 3px 8px rgba(44, 82, 130, 0.2); /* Subtle shadow for primary */
        }

        .button.is-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px); /* Slight lift */
            box-shadow: 0 6px 15px rgba(44, 82, 130, 0.3); /* Enhanced shadow on hover */
        }

        .button.is-danger {
            background: var(--danger-color);
            border: none;
            color: white;
            box-shadow: 0 3px 8px rgba(197, 48, 48, 0.2);
        }

        .button.is-danger:hover {
            background: #a52626; /* Darker red */
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(197, 48, 48, 0.3);
        }

        .button.is-info {
            background: var(--info-color);
            border: none;
            color: white;
        }
        .button.is-info:hover {
            background: #2a65a2;
            transform: translateY(-2px);
        }

        .button.is-warning {
            background: var(--warning-color);
            border: none;
            color: white;
            box-shadow: 0 3px 8px rgba(214, 158, 46, 0.2);
        }
        .button.is-warning:hover {
            background: #b88627;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(214, 158, 46, 0.3);
        }

        .button.is-small {
            font-size: 0.8rem;
            padding: 0.4em 0.8em;
            height: 2.2em;
        }

        .button.is-fullwidth {
            background: var(--danger-color);
            font-weight: 600;
        }

        /* Notification Styling */
        .notification {
            border-radius: 10px; /* More rounded notifications */
            border: none;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08); /* More noticeable shadow */
            padding: 1.25rem 1.5rem; /* More padding */
            margin-bottom: 1.5rem; /* Space below notifications */
            display: flex;
            align-items: center;
        }

        .notification .delete {
            margin-left: auto;
            margin-right: -0.5rem; /* Pull delete button slightly in */
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }
        .notification .delete:hover {
            opacity: 1;
        }

        .notification.is-success {
            background: #e6ffed; /* Lighter success background */
            color: #2f855a;
            border-left: 5px solid var(--success-color); /* Thicker border */
        }

        .notification.is-danger {
            background: #ffebeb; /* Lighter danger background */
            color: #c53030;
            border-left: 5px solid var(--danger-color);
        }

        .select select {
            border-radius: 8px; /* More rounded select boxes */
            border: 1px solid var(--border-color);
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05); /* Clearer inner shadow */
            height: 2.5em; /* Consistent height */
            min-width: 120px;
        }
        .select:not(.is-multiple):not(.is-loading)::after {
            border-color: var(--text-color); /* Darker arrow for better contrast */
        }

        .tag.is-info {
            background: var(--primary-light);
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.4em 0.8em; /* More padding */
            border-radius: 6px; /* Slightly more rounded tags */
            text-transform: capitalize;
        }

        /* Custom scrollbar for main content */
        .main-content::-webkit-scrollbar {
            width: 10px; /* Wider scrollbar */
        }

        .main-content::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 5px;
        }

        .main-content::-webkit-scrollbar-thumb {
            background: #aebfd4; /* Darker thumb */
            border-radius: 5px;
            border: 2px solid #f1f5f9; /* Creates a small gap */
        }

        .main-content::-webkit-scrollbar-thumb:hover {
            background: #7a8aa3; /* Even darker on hover */
        }

        /* Subtle underline effect to active menu item for more definition */
        .sidebar-menu a.is-active::after {
            content: '';
            position: absolute;
            bottom: 6px; /* Raise slightly */
            left: 1.25rem; /* Align with padding */
            right: 1.25rem;
            height: 3px; /* Thicker line */
            background: white;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s ease-out;
        }

        .sidebar-menu a.is-active:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* Image styling in tables */
        .table img {
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.08); /* More prominent shadow for images */
            border-radius: 8px; /* Rounded corners for images */
            object-fit: cover;
            transition: all 0.2s ease;
        }
        .table img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        /* Empty state styling */
        .has-text-centered.has-text-grey {
            padding: 3rem 1rem;
            font-style: italic;
            color: #9aa7b8 !important; /* Slightly more muted grey for empty state */
        }
        .has-text-centered.has-text-grey .fas {
            color: #cbd5e1; /* Lighter icon for empty state */
        }

        /* Responsive Adjustments */
        @media screen and (max-width: 1024px) {
            .admin-sidebar {
                width: 0;
                overflow: hidden;
                box-shadow: none;
            }
            .admin-sidebar.is-active {
                width: 280px;
                box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            }
            .main-content {
                margin-left: 0;
            }
        }

        /* Add a mobile menu toggle if sidebar is collapsible */
        .navbar-burger {
            display: none; /* Hide by default */
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            color: var(--primary-color);
            background-color: white;
            border-radius: 4px;
            padding: 0.5rem;
            box-shadow: var(--card-shadow);
        }
        .navbar-burger span {
            background-color: var(--primary-color);
        }
        @media screen and (max-width: 1024px) {
            .navbar-burger {
                display: flex;
            }
        }

        /* Custom Modal for Delete Confirmation */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 10002; /* Higher than other elements */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.6); /* Darker overlay */
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 450px;
            text-align: center;
            position: relative;
            animation: fadeInScale 0.3s ease-out forwards;
        }

        .modal-icon {
            font-size: 3.5rem;
            color: var(--danger-color);
            margin-bottom: 20px;
            animation: bounceIn 0.6s ease-out;
        }

        .modal-content h3 {
            font-size: 1.6rem;
            color: var(--heading-color);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .modal-content p {
            font-size: 1rem;
            color: var(--text-color);
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .modal-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .modal-button {
            padding: 0.8rem 1.8rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease-out;
            border: none;
        }

        .modal-button.is-confirm {
            background-color: var(--danger-color);
            color: white;
            box-shadow: 0 4px 10px rgba(197, 48, 48, 0.2);
        }
        .modal-button.is-confirm:hover {
            background-color: #a52626;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(197, 48, 48, 0.3);
        }

        .modal-button.is-cancel {
            background-color: #e2e8f0;
            color: #4a5568;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .modal-button.is-cancel:hover {
            background-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes bounceIn {
            0%, 20%, 40%, 60%, 80%, 100% {
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
            }
            0% {
                opacity: 0;
                transform: scale3d(0.3, 0.3, 0.3);
            }
            20% {
                transform: scale3d(1.1, 1.1, 1.1);
            }
            40% {
                transform: scale3d(0.9, 0.9, 0.9);
            }
            60% {
                opacity: 1;
                transform: scale3d(1.03, 1.03, 1.03);
            }
            80% {
                transform: scale3d(0.97, 0.97, 0.97);
            }
            100% {
                opacity: 1;
                transform: scale3d(1, 1, 1);
            }
        }
    </style>
</head>
<body>
    <div class="loading-overlay is-hidden" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <div class="admin-layout">
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="sidebar" onclick="document.getElementById('sidebar').classList.toggle('is-active');">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>

        <div class="admin-sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    @php
                        // Fallback to 'Admin' if Auth::user() is null or nama is empty
                        $userName = Auth::user()->nama ?? 'Admin Petugas';
                        $words = explode(' ', $userName);
                        $initials = '';

                        if (count($words) >= 2) {
                            $initials = strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
                        } elseif (count($words) == 1 && !empty($words[0])) {
                            $initials = strtoupper(substr($words[0], 0, 2)); // Take first two letters if only one word
                        } else {
                            $initials = 'AD';
                        }
                    @endphp
                    <span>{{ $initials }}</span>
                </div>
                <p class="title">SIPADU Administrator</p>
                {{-- <p class="subtitle">Selamat Datang, **{{ Auth::user()->nama ?? 'Admin' }}**</p> --}}
            </div>

            <nav class="sidebar-menu">
                <div class="menu-section">
                    <p class="menu-label">Menu Utama</p>
                    <ul class="menu-list">
                        <li><a href="#dashboard" class="menu-item is-active" data-section="dashboard">
                            <span class="icon"><i class="fas fa-th-large"></i></span> Dashboard
                        </a></li>
                        <li><a href="#pengaduan-section" class="menu-item" data-section="pengaduan">
                            <span class="icon"><i class="fas fa-file-invoice"></i></span> Pengaduan Masyarakat
                        </a></li>
                        <li><a href="#users-section" class="menu-item" data-section="users">
                            <span class="icon"><i class="fas fa-users-cog"></i></span> Manajemen Pengguna
                        </a></li>
                        <li><a href="#tanggapan-section" class="menu-item" data-section="tanggapan">
                            <span class="icon"><i class="fas fa-reply-all"></i></span> Respons Pengaduan
                        </a></li>
                    </ul>
                </div>

                <div class="menu-section">
                    <p class="menu-label">Pengaturan Sistem</p>
                    <ul class="menu-list">
                        <li><a href="#password-reset-section" class="menu-item" data-section="password-reset">
                            <span class="icon"><i class="fas fa-lock"></i></span> Reset Kata Sandi
                        </a></li>
                    </ul>
                </div>
            </nav>

            <div class="logout-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="button is-danger is-fullwidth">
                        <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span>Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </div>

        <main class="main-content">
            <div class="page-header">
                <h1 class="page-title">Panel Administrasi SIPADU</h1>
                <p class="page-subtitle">Kelola sistem informasi pengaduan masyarakat secara efisien.</p>
                <p class="page-subtitle" id="current-time"></p>
            </div>

            @if(session('success'))
                <div class="notification is-success">
                    <button class="delete"></button>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="notification is-danger">
                    <button class="delete"></button>
                    {{ session('error') }}
                </div>
            @endif

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon primary">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $pengaduans->count() }}</div>
                            <div class="stat-label">Jumlah Pengaduan</div>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon success">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $users->count() }}</div>
                            <div class="stat-label">Total Pengguna</div>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon warning">
                            <i class="fas fa-comment-dots"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $tanggapans->count() }}</div>
                            <div class="stat-label">Jumlah Tanggapan</div>
                        </div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon danger">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">{{ $pengaduans->where('status', 'menunggu')->count() }}</div>
                            <div class="stat-label">Pengaduan Tertunda</div>
                        </div>
                    </div>
                </div>
            </div>

           <div id="pengaduan-section" class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Pengaduan Masuk</h2>
                    <p class="card-subtitle">Manajemen dan pemantauan seluruh pengaduan yang telah diajukan oleh masyarakat.</p>
                </div>
                <div class="card-content">
                    <div class="action-buttons mb-4">
                        <a href="{{ route('UserExcel') }}" class="button is-info">
                            <span class="icon"><i class="fas fa-file-pdf"></i></span>
                            <span>Cetak PDF</span>
                        </a>
                        <a href="{{ route('admin.pengaduan.export.excel') }}" class="button is-success"> 
                         <span class="icon"><i class="fas fa-file-excel"></i></span> 
                          <span>Export Excel</span> 
                        </a> 
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table is-fullwidth is-striped is-hoverable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pelapor</th>
                                    <th>Judul Pengaduan</th>
                                    <th>kategori</th>
                                    <th>Isi Ringkas</th>
                                    <th>Foto Lampiran</th>
                                    <th>Status</th>
                                    <th>Ubah Status</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduans as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $p->user->nama }}</strong></td>
                                    <td>{{ $p->judul }}</td>
                                     <td>
                                        {{-- tampilkan nama kategori atau tanda "-" kalau null --}}
                                        {{ $p->kategori ? $p->kategori->nama_kategori : '-' }}
                                    </td>
                                    <td>
                                        {{ Str::limit($p->isi, 50) }}
                                        @if(strlen($p->isi) > 50)
                                            <span title="{{ $p->isi }}">...</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($p->foto)
                                            <img src="{{ asset('storage/' . $p->foto) }}" width="70" height="70" alt="Foto Pengaduan">
                                        @else
                                            <span class="has-text-grey">Tidak Ada</span>
                                        @endif
                                    </td>
                                    <td><span class="status-badge status-{{ strtolower($p->status) }}">{{ ucfirst($p->status) }}</span></td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.pengaduan.updateStatus', $p->id_pengaduan) }}">
                                            @csrf
                                            <div class="select is-small">
                                                <select name="status" onchange="this.form.submit()">
                                                    <option value="menunggu" {{ $p->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                                    <option value="diproses" {{ $p->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                    <option value="selesai" {{ $p->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form id="delete-pengaduan-{{ $p->id_pengaduan }}" method="POST" action="{{ route('admin.pengaduan.destroy', $p->id_pengaduan) }}" onsubmit="event.preventDefault(); showDeleteConfirmation('delete-pengaduan-{{ $p->id_pengaduan }}', 'pengaduan');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button is-danger is-small" type="submit">
                                                <span class="icon"><i class="fas fa-trash-alt"></i></span>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="has-text-centered has-text-grey">
                                        <i class="fas fa-inbox fa-3x mb-3"></i><br>
                                        Tidak ada data pengaduan yang tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="users-section" class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Manajemen Akun Pengguna</h2>
                    <p class="card-subtitle">Pengelolaan akun pengguna dan hak akses dalam sistem SIPADU.</p>
                </div>
                <div class="card-content">
                    <div class="action-buttons">
                        <a href="{{ route('admin.users.create') }}" class="button is-primary">
                            <span class="icon"><i class="fas fa-user-plus"></i></span> <span>Tambah Pengguna Baru</span>
                        </a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table is-fullwidth is-striped is-hoverable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat Email</th>
                                    <th>Peran</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $user->nama }}</strong></td>
                                    <td>{{ $user->email }}</td>
                                    <td><span class="tag is-info">{{ ucfirst($user->role) }}</span></td>
                                    <td>
                                        <div class="buttons">
                                            <a href="{{ route('admin.users.edit', $user->id_user) }}" class="button is-warning is-small">
                                                <span class="icon">
                                                    <i class="fas fa-user-edit"></i>
                                                </span>
                                                <span>Edit</span>
                                            </a>
                                            <form id="delete-user-{{ $user->id_user }}" method="POST"
                                                action="{{ route('admin.users.destroy', $user->id_user) }}"
                                                onsubmit="event.preventDefault(); showDeleteConfirmation('delete-user-{{ $user->id_user }}', 'akun pengguna');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button is-danger is-small" type="submit">
                                                    <span class="icon">
                                                        <i class="fas fa-user-times"></i>
                                                    </span>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="has-text-centered has-text-grey">
                                        <i class="fas fa-users-slash fa-3x mb-3"></i><br>
                                        Tidak ada data pengguna yang terdaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div id="tanggapan-section" class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Manajemen Respons Pengaduan</h2>
                    <p class="card-subtitle">Pengelolaan tanggapan yang diberikan terhadap pengaduan masyarakat.</p>
                </div>
                <div class="card-content">
                    <div class="action-buttons">
                        <a href="{{ route('admin.tanggapans.create') }}" class="button is-primary">
                            <span class="icon"><i class="fas fa-plus-square"></i></span> <span>Buat Tanggapan Baru</span>
                        </a>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table is-fullwidth is-striped is-hoverable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID Pengaduan</th>
                                    <th>Petugas</th>
                                    <th>Isi Tanggapan</th>
                                    <th>Tanggal Respons</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tanggapans as $index => $tanggapan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="tag is-info">#{{ $tanggapan->id_pengaduan }}</span></td>
                                    <td><strong>{{ $tanggapan->admin->nama ?? 'N/A' }}</strong></td>
                                    <td>
                                        {{ Str::limit($tanggapan->isi_tanggapan, 50) }}
                                        @if(strlen($tanggapan->isi_tanggapan) > 50)
                                            <span title="{{ $tanggapan->isi_tanggapan }}">...</span>
                                        @endif
                                    </td>
                                    <td>{{ $tanggapan->tanggal_tanggapan->translatedFormat('d M Y, H:i') }}</td>
                                    <td>
                                        <div class="buttons">
                                            <a href="{{ route('admin.tanggapans.edit', $tanggapan->id_tanggapan) }}" class="button is-warning is-small">
                                                <span class="icon"><i class="fas fa-pencil-alt"></i></span> <span>Edit</span>
                                            </a>
                                            <form id="delete-tanggapan-{{ $tanggapan->id_tanggapan }}" method="POST" action="{{ route('admin.tanggapans.destroy', $tanggapan->id_tanggapan) }}" onsubmit="event.preventDefault(); showDeleteConfirmation('delete-tanggapan-{{ $tanggapan->id_tanggapan }}', 'tanggapan');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="button is-danger is-small" type="submit">
                                                    <span class="icon"><i class="fas fa-trash-alt"></i></span> <span>Hapus</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="has-text-centered has-text-grey">
                                        <i class="fas fa-comment-slash fa-3x mb-3"></i><br>
                                        Tidak ada data tanggapan yang tercatat.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="password-reset-section" class="content-card">
                <div class="card-header">
                    <h2 class="card-title">Daftar Token Reset Kata Sandi</h2>
                    <p class="card-subtitle">Pantau dan kelola token yang digunakan untuk mengatur ulang kata sandi pengguna.</p>
                </div>
                <div class="card-content">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="table is-fullwidth is-striped is-hoverable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Alamat Email</th>
                                    <th>Token</th>
                                    <th>Tanggal Pembuatan</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($passwordResets as $index => $pr)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $pr->email }}</strong></td>
                                    <td><code style="background: #eef2f6; padding: 0.3rem 0.6rem; border-radius: 5px; color: #3b4a5d; font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace;">{{ Str::limit($pr->token, 20) }}</code></td>
                                    <td>{{ $pr->created_at->translatedFormat('d M Y, H:i') }}</td>
                                    <td>
                                        <form id="delete-token-{{ Str::slug($pr->email) }}" method="POST" action="{{ route('admin.password_resets.destroy', $pr->email) }}" onsubmit="event.preventDefault(); showDeleteConfirmation('delete-token-{{ Str::slug($pr->email) }}', 'token reset kata sandi');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button is-danger is-small" type="submit">
                                                <span class="icon"><i class="fas fa-eraser"></i></span> <span>Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="has-text-centered has-text-grey">
                                        <i class="fas fa-lock-open fa-3x mb-3"></i><br>
                                        Tidak ada token reset kata sandi yang tercatat.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="deleteConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="icon modal-icon"><i class="fas fa-exclamation-triangle"></i></span>
            <h3 id="modalTitle">Konfirmasi Penghapusan</h3>
            <p id="modalMessage">Apakah Anda yakin ingin menghapus data ini secara permanen?</p>
            <div class="modal-buttons">
                <button class="modal-button is-confirm" id="confirmDeleteButton">Ya, Hapus</button>
                <button class="modal-button is-cancel" id="cancelDeleteButton">Batal</button>
            </div>
        </div>
    </div>

    <script>
        // Loading overlay
        window.addEventListener('load', function() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            setTimeout(() => {
                loadingOverlay.classList.add('is-hidden');
            }, 300); // Shorter timeout for faster perceived load
        });

        // Smooth scrolling for menu items
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove active class from all menu items
                document.querySelectorAll('.menu-item').forEach(menuItem => {
                    menuItem.classList.remove('is-active');
                });

                // Add active class to clicked item
                this.classList.add('is-active');

                // Get target section
                const targetSection = this.getAttribute('href');
                const section = document.querySelector(targetSection);

                if (section) {
                    section.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-hide notifications
        document.querySelectorAll('.notification .delete').forEach(deleteBtn => {
            deleteBtn.addEventListener('click', function() {
                this.parentElement.style.opacity = '0';
                this.parentElement.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    this.parentElement.remove();
                }, 300);
            });
        });

        // Auto-hide notifications after 7 seconds
        setTimeout(() => {
            document.querySelectorAll('.notification').forEach(notification => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            });
        }, 7000); // Increased to 7 seconds

        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('is-active');
        }
        // Attach toggle function to burger icon
        document.addEventListener('DOMContentLoaded', () => {
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
            if ($navbarBurgers.length > 0) {
                $navbarBurgers.forEach(el => {
                    el.addEventListener('click', () => {
                        const target = el.dataset.target;
                        const $target = document.getElementById(target);
                        el.classList.toggle('is-active');
                        $target.classList.toggle('is-active');
                    });
                });
            }
        });


        // Form submission loading states
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitButton = form.querySelector('button[type="submit"]');
                if (submitButton) {
                    submitButton.classList.add('is-loading');
                    submitButton.disabled = true;
                }
            });
        });

        // Add tooltips to buttons
        document.querySelectorAll('.button').forEach(button => {
            const icon = button.querySelector('.icon i');
            if (icon && !button.getAttribute('title')) { // Only add if no existing title
                let tooltipText = '';
                if (icon.classList.contains('fa-eye')) tooltipText = 'Lihat Detail';
                if (icon.classList.contains('fa-edit') || icon.classList.contains('fa-user-edit') || icon.classList.contains('fa-pencil-alt')) tooltipText = 'Edit Data';
                if (icon.classList.contains('fa-trash') || icon.classList.contains('fa-trash-alt') || icon.classList.contains('fa-user-times') || icon.classList.contains('fa-eraser')) tooltipText = 'Hapus Data';
                if (icon.classList.contains('fa-plus') || icon.classList.contains('fa-user-plus') || icon.classList.contains('fa-plus-square')) tooltipText = 'Tambah Data Baru';
                if (icon.classList.contains('fa-sign-out-alt')) tooltipText = 'Keluar dari Sistem';

                if (tooltipText) {
                    button.setAttribute('title', tooltipText);
                }
            }
        });

        // Real-time clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const clockElement = document.getElementById('current-time');
            if (clockElement) {
                clockElement.textContent = `Tanggal: ${dateString} | Waktu: ${timeString}`;
            }
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call to display immediately

        // Performance monitoring - kept for debugging/insight, but not directly visible
        if ('performance' in window) {
            window.addEventListener('load', function() {
                setTimeout(() => {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    console.log(`Page loaded in ${Math.round(perfData.loadEventEnd - perfData.fetchStart)}ms`);
                }, 0);
            });
        }

        // Prevent accidental form submissions (redundancy with is-loading, but good safeguard)
        let isSubmitting = false;
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (isSubmitting) {
                    e.preventDefault();
                    return false;
                }
                isSubmitting = true;

                setTimeout(() => {
                    isSubmitting = false;
                }, 3000); // Reset after 3 seconds
            });
        });

        // Add keyboard shortcuts to menu items
        document.addEventListener('keydown', function(e) {
            // Check for Alt key + number (1-5)
            if (e.altKey) {
                let targetSectionId = '';
                switch (e.key) {
                    case '1': targetSectionId = 'dashboard'; break;
                    case '2': targetSectionId = 'pengaduan'; break;
                    case '3': targetSectionId = 'users'; break;
                    case '4': targetSectionId = 'tanggapan'; break;
                    case '5': targetSectionId = 'password-reset'; break;
                }

                if (targetSectionId) {
                    e.preventDefault(); // Prevent default browser behavior (e.g., Alt+D opens bookmark menu)
                    const menuItem = document.querySelector(`.menu-item[data-section="${targetSectionId}"]`);
                    if (menuItem) {
                        menuItem.click(); // Programmatically click the menu item
                    }
                }
            }
        });

        // Intersection Observer for scroll animations (re-applied and slightly enhanced)
        const observerOptions = {
            threshold: 0.05, // Trigger animation when 5% of element is visible
            rootMargin: '0px 0px -20px 0px' // Reduce bottom margin to trigger slightly earlier
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up'); // Add a class for animation
                    observer.unobserve(entry.target); // Stop observing once animated
                }
            });
        }, observerOptions);

        // Initial setup for elements to be animated
        document.querySelectorAll('.content-card, .stat-card').forEach(card => {
            card.classList.add('fade-in-up-init'); // Initial state for animation
            observer.observe(card);
        });

        // CSS for fade-in-up animation
        const styleSheet = document.createElement("style");
        styleSheet.type = "text/css";
        styleSheet.innerText = `
            .fade-in-up-init {
                opacity: 0;
                transform: translateY(20px);
                transition: opacity 0.8s cubic-bezier(0.2, 0.8, 0.2, 1), transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
            }
            .fade-in-up {
                opacity: 1;
                transform: translateY(0);
            }
        `;
        document.head.appendChild(styleSheet);


        // Custom Delete Confirmation Modal Logic
        let formToSubmit = null;

        function showDeleteConfirmation(formId, itemName) {
            const modal = document.getElementById('deleteConfirmationModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            
            modalTitle.textContent = `Hapus ${itemName}?`;
            modalMessage.textContent = `Apakah Anda yakin ingin menghapus ${itemName} ini secara permanen? Tindakan ini tidak dapat dibatalkan.`;
            
            formToSubmit = document.getElementById(formId);
            modal.style.display = 'flex'; // Use flex to center
        }

        document.getElementById('confirmDeleteButton').addEventListener('click', function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
            closeDeleteConfirmationModal();
        });

        document.getElementById('cancelDeleteButton').addEventListener('click', function() {
            closeDeleteConfirmationModal();
        });

        function closeDeleteConfirmationModal() {
            const modal = document.getElementById('deleteConfirmationModal');
            modal.style.display = 'none';
            formToSubmit = null; // Clear the form reference
        }

        // Close modal if clicked outside content
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteConfirmationModal');
            if (event.target == modal) {
                closeDeleteConfirmationModal();
            }
        });

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && document.getElementById('deleteConfirmationModal').style.display === 'flex') {
                closeDeleteConfirmationModal();
            }
        });

    </script>
</body>
</html>