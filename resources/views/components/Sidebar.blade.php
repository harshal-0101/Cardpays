<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<body>

<div class="crm-sidebar">
    <div class="crm-sidebar-header">
        CardsPay
    </div>
    
    <nav class="flex-1 overflow-y-auto">
        
        @php
            $activeClass = 'nav-link-active';
            $inactiveClass = 'nav-link-inactive';
        @endphp


        <a href="{{ route('admin.admin') }}" 
           class="nav-link 
           {{ request()->routeIs('admin.admin') ? $activeClass : $inactiveClass }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.942 3.313.805 2.551 2.433a1.724 1.724 0 00.046 2.607c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-.046 2.607c.762 1.628-.977 3.37-2.551 2.433a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.942-3.313-.805-2.551-2.433a1.724 1.724 0 00-.046-2.607c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 00.046-2.607c-.762-1.628.977-3.37 2.551-2.433a1.724 1.724 0 002.573-1.066z"></path></svg>
            Admin Settings
        </a>

        <a href="{{ route('leads.Lead') }}"     
           class="nav-link mt-4 
           {{ request()->routeIs('leads.Lead') ? $activeClass : $inactiveClass }}"> 
           
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>
            Lead Management
        </a>

        <a href="{{ route('caller.caller') }}"     
           class="nav-link mt-4 
           {{ request()->routeIs('caller.caller') ? $activeClass : $inactiveClass }}"> 
           
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>
            Caller
        </a>

        <a href="{{ route('manager.manager') }}"     
           class="nav-link mt-4 
           {{ request()->routeIs('manager.manager') ? $activeClass : $inactiveClass }}"> 
           
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M12 20a8 8 0 100-16 8 8 0 000 16z"></path></svg>
            Manager
        </a>

        </nav>
</div>