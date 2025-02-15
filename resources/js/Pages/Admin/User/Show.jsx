import { Head, Link } from "@inertiajs/react";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import PageHeader from "@/Components/PageHeader";

import "react-datepicker/dist/react-datepicker.css";
import SuccessMessage from "@/Components/SuccessMessage";

export default function Show({ auth, user, company, success, employee }) {
    const breadcrumbs = [
        { name: company.name, href: route("company.show", company.id) },
        { name: "Users", href: route("user.index", company.id) },
        { name: user.name, href: route("user.show", [company.id, user.id]) },
    ];
    return (
        <AuthenticatedAdmin
            user={auth.user}
            header={<PageHeader breadcrumbs={breadcrumbs} />}
        >
            <Head title={`User ${user.name}`} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <SuccessMessage>{success}</SuccessMessage>
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="overflow-auto">
                                <div className="grid gap-1 grid-cols-2 mt-2">
                                    {/* left side of grid */}
                                    <div>
                                        <div>
                                            <label className="font-bold text-lg">
                                                User ID
                                            </label>
                                            <p className="mt-1">{user.id}</p>
                                        </div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                User Name
                                            </label>
                                            <p className="mt-1">{user.name}</p>
                                        </div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                Email
                                            </label>
                                            <p className="mt-1">{user.email}</p>
                                        </div>
                                    </div>
                                    {/* right side of grid */}
                                    <div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                Email Verification
                                            </label>
                                            <p className="mt-1">
                                                {user.verified
                                                    ? `Verified`
                                                    : `Not Verified`}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {user.verified && employee == null && (
                    <div className="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-6 text-gray-900 dark:text-gray-100">
                                <div className="flex justify-between items-center">
                                    <div className="text-gray-900 dark:text-gray-100">
                                        User has not set as employee
                                    </div>
                                    <Link
                                        className="flex bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600 float-right"
                                        href={route(`employee.create`, [
                                            company.id,
                                            user.id,
                                        ])}
                                    >
                                        Set up user as employee
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                {user.verified && employee && (
                    <div className="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-6 text-gray-900 dark:text-gray-100">
                                <div className="flex justify-between items-center">
                                    <div className="text-gray-900 dark:text-gray-100 font-bold text-lg py-6">
                                        Employee Data
                                    </div>
                                    <Link
                                        className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                                        href={route(`employee.edit`, [
                                            company.id,
                                            user.id,
                                            employee.id,
                                        ])}
                                    >
                                        Edit Employee Data
                                    </Link>
                                </div>
                                <div className="overflow-auto">
                                    <div className="grid gap-1 grid-cols-2 mt-2">
                                        {/* left side of grid */}
                                        <div>
                                            <div>
                                                <div>
                                                    <label className="font-bold text-lg">
                                                        Role
                                                    </label>
                                                    <p className="mt-1">
                                                        {employee.role.name}
                                                    </p>
                                                </div>
                                                <div className="mt-4">
                                                    <label className="font-bold text-lg">
                                                        Birth Date
                                                    </label>
                                                    <p className="mt-1">
                                                        {employee.date_of_birth}
                                                    </p>
                                                </div>

                                                <div className="mt-4">
                                                    <label className="font-bold text-lg">
                                                        Gender
                                                    </label>
                                                    <p className="mt-1">
                                                        {employee.gender == 1
                                                            ? "Male"
                                                            : "Female"}
                                                    </p>
                                                </div>

                                                <div className="mt-4">
                                                    <label className="font-bold text-lg">
                                                        Marital Status
                                                    </label>
                                                    <p className="mt-1">
                                                        {
                                                            employee.marital_status
                                                        }
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        {/* right side of grid */}
                                        <div>
                                            <div className="mt-4">
                                                <label className="font-bold text-lg">
                                                    Education Degree
                                                </label>
                                                <p className="mt-1">
                                                    {employee.education_degree}
                                                </p>
                                            </div>
                                            <div className="mt-4">
                                                <label className="font-bold text-lg">
                                                    Graduation Year
                                                </label>
                                                <p className="mt-1">
                                                    {employee.graduation_year}
                                                </p>
                                            </div>
                                            <div className="mt-4">
                                                <label className="font-bold text-lg">
                                                    Military Status
                                                </label>
                                                <p className="mt-1">
                                                    {employee.military_status}
                                                </p>
                                            </div>
                                            <div className="mt-4">
                                                <label className="font-bold text-lg">
                                                    Hiring Date
                                                </label>
                                                <p className="mt-1">
                                                    {employee.hiring_date}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AuthenticatedAdmin>
    );
}
