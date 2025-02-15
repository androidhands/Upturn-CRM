import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PageHeader from "@/Components/PageHeader";
import SelectInput from "@/Components/SelectInput";
import TextInput from "@/Components/TextInput";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import {
    EDUCATION_DEGREE_LIST,
    MARITAL_STATUS_LIST,
    MILITARY_STATUS_LIST,
} from "@/Pages/Constants/Constants";
import { Head, Link, useForm } from "@inertiajs/react";
import ReactDatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
export default function Create({ auth, user, company, roles }) {
    const { data, setData, post, errors, reset } = useForm({
        role_id: "",
        date_of_birth: "",
        gender: "",
        education_degree: "",
        graduation_year: "",
        military_status: "",
        marital_tatus: "",
        hiring_date: "",
    });
    const onSubmit = (e) => {
        e.preventDefault();
        post(route("employee.store", [company.id, user.id]));
    };

    const breadcrumbs = [
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

                {user.verified && (
                    <div className="mt-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div className="p-6 text-gray-900 dark:text-gray-100">
                                <div className="text-gray-900 dark:text-gray-100">
                                    Setup User As Employee
                                </div>
                                <form onSubmit={onSubmit}>
                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="employee_role"
                                            value="Employee Role"
                                        />
                                        <SelectInput
                                            id="employee_role"
                                            name="role_id"
                                            className="mt-1 block w-full"
                                            onChange={(e) =>
                                                setData(
                                                    "role_id",
                                                    e.target.value
                                                )
                                            }
                                        >
                                            <option value="">
                                                Select Role
                                            </option>
                                            {roles.data.map((role) => (
                                                <option
                                                    key={role.id}
                                                    value={role.id}
                                                >
                                                    {role.name}
                                                </option>
                                            ))}
                                        </SelectInput>
                                        <InputError
                                            message={errors.role_id}
                                            className="mt-2 "
                                        />
                                    </div>
                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="date_of_birth"
                                            value="Birth Date"
                                        />
                                        <TextInput
                                            id="date_of_birth"
                                            type="date"
                                            name="date_of_birth"
                                            value={data.date_of_birth}
                                            className="mt-1 block w-full dark-calendar-icon"
                                            onChange={(e) =>
                                                setData(
                                                    "date_of_birth",
                                                    e.target.value
                                                )
                                            }
                                        />
                                        <InputError
                                            message={errors.date_of_birth}
                                            className="mt-2 "
                                        />
                                    </div>

                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="employee_gender"
                                            value="Employee Gender"
                                        />
                                        <SelectInput
                                            id="employee_gender"
                                            name="gender"
                                            className="mt-1 block w-full"
                                            onChange={(e) =>
                                                setData(
                                                    "gender",
                                                    e.target.value == "male"
                                                        ? 1
                                                        : 0
                                                )
                                            }
                                        >
                                            <option value="">
                                                Select Gender
                                            </option>
                                            <option value="male">Male</option>
                                            <option value="female">
                                                Female
                                            </option>
                                        </SelectInput>
                                        <InputError
                                            message={errors.gender}
                                            className="mt-2 "
                                        />
                                    </div>

                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="employee_education_degree"
                                            value="Education Degree"
                                        />
                                        <SelectInput
                                            id="employee_education_degree"
                                            name="education_degree"
                                            className="mt-1 block w-full"
                                            onChange={(e) =>
                                                setData(
                                                    "education_degree",
                                                    e.target.value
                                                )
                                            }
                                        >
                                            <option value="">
                                                Select Education Degree
                                            </option>

                                            {EDUCATION_DEGREE_LIST.map(
                                                (degree) => (
                                                    <option
                                                        key={EDUCATION_DEGREE_LIST.indexOf(
                                                            degree
                                                        )}
                                                        value={degree}
                                                    >
                                                        {degree}
                                                    </option>
                                                )
                                            )}
                                        </SelectInput>
                                        <InputError
                                            message={errors.education_degree}
                                            className="mt-2 "
                                        />
                                    </div>
                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="employee_graduation_year"
                                            value="Graduation Year"
                                        />
                                        <ReactDatePicker
                                            id="employee_graduation_year"
                                            selected={
                                                data.graduation_year
                                                    ? new Date(
                                                          data.graduation_year,
                                                          0,
                                                          1
                                                      )
                                                    : null
                                            }
                                            onChange={(date) =>
                                                setData(
                                                    "graduation_year",
                                                    date == null
                                                        ? ""
                                                        : date.getFullYear()
                                                )
                                            }
                                            showYearPicker
                                            dateFormat="yyyy"
                                            className="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 focus:border-green-500 dark:focus:border-green-600 focus:ring-green-500 dark:focus:ring-green-600 rounded-md shadow-sm dark:text-white"
                                        />
                                        <InputError
                                            message={errors.graduation_year}
                                            className="mt-2"
                                        />
                                    </div>
                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="employee_military_status"
                                            value="Military Status"
                                        />
                                        <SelectInput
                                            id="employee_military_status"
                                            name="military_status"
                                            className="mt-1 block w-full"
                                            onChange={(e) =>
                                                setData(
                                                    "military_status",
                                                    e.target.value
                                                )
                                            }
                                        >
                                            <option value="">
                                                Select Military Status
                                            </option>

                                            {MILITARY_STATUS_LIST.map(
                                                (status) => (
                                                    <option
                                                        key={MILITARY_STATUS_LIST.indexOf(
                                                            status
                                                        )}
                                                        value={status}
                                                    >
                                                        {status}
                                                    </option>
                                                )
                                            )}
                                        </SelectInput>
                                        <InputError
                                            message={errors.military_status}
                                            className="mt-2 "
                                        />
                                    </div>

                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="employee_marital_status"
                                            value="Marital Status"
                                        />
                                        <SelectInput
                                            id="employee_marital_status"
                                            name="marital_status"
                                            className="mt-1 block w-full"
                                            onChange={(e) =>
                                                setData(
                                                    "marital_status",
                                                    e.target.value
                                                )
                                            }
                                        >
                                            <option value="">
                                                Select Marital Status
                                            </option>

                                            {MARITAL_STATUS_LIST.map(
                                                (status) => (
                                                    <option
                                                        key={MARITAL_STATUS_LIST.indexOf(
                                                            status
                                                        )}
                                                        value={status}
                                                    >
                                                        {status}
                                                    </option>
                                                )
                                            )}
                                        </SelectInput>
                                        <InputError
                                            message={errors.marital_status}
                                            className="mt-2 "
                                        />
                                    </div>

                                    <div className="mt-4">
                                        <InputLabel
                                            htmlFor="employee_hiring_date"
                                            value="Hiring Date"
                                        />
                                        <TextInput
                                            id="employee_hiring_date"
                                            type="date"
                                            name="hiring_date"
                                            value={data.hiring_date}
                                            className="mt-1 block w-full dark-calendar-icon"
                                            onChange={(e) =>
                                                setData(
                                                    "hiring_date",
                                                    e.target.value
                                                )
                                            }
                                        />
                                        <InputError
                                            message={errors.hiring_date}
                                            className="mt-2 "
                                        />
                                    </div>

                                    <div className="mt-4 text-right">
                                        <Link
                                            href={route("user.show", [
                                                company.id,
                                                user.id,
                                            ])}
                                            className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2"
                                        >
                                            Cancel
                                        </Link>
                                        <button className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                )}
            </div>
        </AuthenticatedAdmin>
    );
}
