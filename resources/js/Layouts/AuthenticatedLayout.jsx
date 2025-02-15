import { useState } from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import { Link } from "@inertiajs/react";

const Authenticated = ({ user, header, children }) => {
    const [isCollapsed, setIsCollapsed] = useState(false);

    return (
        <div className="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            {/* Sidebar */}
            <aside
                className={`
                    fixed left-0 top-0 h-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700
                    transition-all duration-300 flex flex-col
                    ${isCollapsed ? "w-16" : "w-64"}
                `}
            >
                {/* Logo section */}
                <div className="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    {!isCollapsed && (
                        <Link href="/">
                            <ApplicationLogo className="h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </Link>
                    )}
                    <button
                        onClick={() => setIsCollapsed(!isCollapsed)}
                        className="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400"
                    >
                        {/* Chevron icons using SVG */}
                        {isCollapsed ? (
                            <svg
                                className="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        ) : (
                            <svg
                                className="w-5 h-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>
                        )}
                    </button>
                </div>

                {/* Profile section */}
                <div
                    className={`p-4 border-b border-gray-200 dark:border-gray-700 ${
                        isCollapsed ? "text-center" : ""
                    }`}
                >
                    <div className="relative">
                        <img
                            src="/api/placeholder/150/150"
                            alt="Profile"
                            className={`rounded-full mx-auto bg-gray-200 ${
                                isCollapsed ? "w-8 h-8" : "w-16 h-16"
                            }`}
                        />
                    </div>
                    {!isCollapsed && (
                        <>
                            <h3 className="mt-2 font-medium text-gray-900 dark:text-gray-100">
                                {user.name}
                            </h3>
                            <p className="text-sm text-gray-500 dark:text-gray-400">
                                {user.email}
                            </p>
                        </>
                    )}
                </div>

                {/* Navigation section */}
                <nav className="flex-1 p-2 space-y-1">
                    <Link
                        href={route("dashboard")}
                        className={`
                            flex items-center gap-2 p-2 rounded-lg transition-colors
                            ${
                                route().current("dashboard")
                                    ? "bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400"
                                    : "text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/30 hover:text-green-600 dark:hover:text-green-400"
                            }
                            ${isCollapsed ? "justify-center" : ""}
                        `}
                    >
                        <svg
                            className="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth={2}
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                            />
                        </svg>
                        {!isCollapsed && <span>Dashboard</span>}
                    </Link>

                    <Link
                        href={route("profile.edit")}
                        className={`
                            flex items-center gap-2 p-2 rounded-lg transition-colors
                            ${
                                route().current("profile.edit")
                                    ? "bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400"
                                    : "text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/30 hover:text-green-600 dark:hover:text-green-400"
                            }
                            ${isCollapsed ? "justify-center" : ""}
                        `}
                    >
                        <svg
                            className="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth={2}
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>
                        {!isCollapsed && <span>Profile</span>}
                    </Link>
                </nav>

                {/* Logout section */}
                <div className="p-2 border-t border-gray-200 dark:border-gray-700">
                    <Link
                        href={route("logout")}
                        method="post"
                        as="button"
                        className={`
                            w-full flex items-center gap-2 p-2 rounded-lg
                            text-gray-700 dark:text-gray-300 hover:bg-green-50 dark:hover:bg-green-900/30
                            hover:text-green-600 dark:hover:text-green-400 transition-colors
                            ${isCollapsed ? "justify-center" : ""}
                        `}
                    >
                        <svg
                            className="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                strokeWidth={2}
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                            />
                        </svg>
                        {!isCollapsed && <span>Log Out</span>}
                    </Link>
                </div>
            </aside>

            {/* Main content */}
            <div
                className={`flex-1 transition-all duration-300 ${
                    isCollapsed ? "ml-16" : "ml-64"
                }`}
            >
                {header && (
                    <header className="bg-white dark:bg-gray-800 shadow">
                        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {header}
                        </div>
                    </header>
                )}
                <main className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {children}
                </main>
            </div>
        </div>
    );
};

export default Authenticated;
