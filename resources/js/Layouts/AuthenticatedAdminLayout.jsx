import { useState } from 'react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { Link } from '@inertiajs/react';
import AppLogo from '@/Components/SvgIcons/AppLogo';

export default function AuthenticatedAdmin({ user, header, children }) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);

    return (
        <div className="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            {/* Sidebar Navigation */}
            <nav className="bg-white dark:bg-gray-800 w-64 min-h-screen border-r border-gray-200 dark:border-gray-700">
                <div className="px-4 py-6">
                    {/* Application Logo */}
                    <div className="flex items-center justify-center mb-6">
                        <Link href="/">
                           
                            <ApplicationLogo className="block h-20 w-30 fill-current text-gray-800 dark:text-gray-200" />
                        </Link>
                    </div>

                      {/* User Dropdown */}
                <div className="w-full justify-left">
                    <Dropdown>
                        <Dropdown.Trigger>
                            <button
                                type="button"
                                className="w-full flex items-left justify-between px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 transition"
                            >
                                {user.name}
                                <svg
                                    className="ml-2 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fillRule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clipRule="evenodd"
                                    />
                                </svg>
                            </button>
                        </Dropdown.Trigger>

                        <Dropdown.Content>
                            <Dropdown.Link href={route('admin_profile.edit')}>Profile</Dropdown.Link>
                            <Dropdown.Link href={route('logout')} method="post" as="button">
                                Log Out
                            </Dropdown.Link>
                        </Dropdown.Content>
                    </Dropdown>
                </div>

                    {/* Navigation Menu */}
                    <div className="space-y-2">
                        <NavLink href={route('admin_dashboard')} active={route().current('admin_dashboard')}>
                            Admin Dashboard
                        </NavLink>
                        <NavLink href={route('country.index')} active={route().current('country.index')}>
                            Countries
                        </NavLink>
                        <NavLink href={route('company.index')} active={route().current('company.index')}>
                            Companies
                        </NavLink>
                        
                    </div>
                </div>

              
            </nav>

            {/* Main Content */}
            <div className="flex-1">
                {header && (
                    <header className="bg-white dark:bg-gray-800 shadow">
                        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">{header}</div>
                    </header>
                )}

                <main>{children}</main>
            </div>
        </div>
    );
}
