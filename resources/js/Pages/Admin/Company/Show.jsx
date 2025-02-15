import CompanySetup from "@/Components/CompanySetup";
import InputLabel from "@/Components/InputLabel";
import NavLink from "@/Components/NavLink";
import SvgBusinessUnit from "@/Components/SvgIcons/BusinessUnit";
import SvgDepartment from "@/Components/SvgIcons/Department";
import SvgDistrict from "@/Components/SvgIcons/District";
import SvgLines from "@/Components/SvgIcons/Lines";
import SvgOffice from "@/Components/SvgIcons/Office";
import SvgProduct from "@/Components/SvgIcons/Product";
import SvgRegion from "@/Components/SvgIcons/Region";
import SvgRole from "@/Components/SvgIcons/Role";
import SvgStructure from "@/Components/SvgIcons/Structure";
import SvgTerritory from "@/Components/SvgIcons/Territory";
import SvgUser from "@/Components/SvgIcons/User";
import SvgWidget from "@/Components/SvgWidget";
import AuthenticatedAdmin from "@/Layouts/AuthenticatedAdminLayout";
import { Head, Link, router } from "@inertiajs/react";

export default function Show({ auth, company, baseUrl }) {
    return (
        <AuthenticatedAdmin
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{`Company ${company.name}`}</h2>
            }
        >
            <Head title={`Company ${company.name}`} />
            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div>
                            <img
                                src={`${baseUrl}/storage/${company.logoUrl}`}
                                alt=""
                                className="w-full h-64 object-fill"
                            />
                        </div>
                        <div className="p-6 text-gray-900 dark:text-gray-100">
                            <div className="overflow-auto">
                                <div className="grid gap-1 grid-cols-2 mt-2">
                                    {/* left side of grid */}
                                    <div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                Selected Countries
                                            </label>

                                            <div
                                                id="countries_select"
                                                className="mt-2"
                                            >
                                                {company.countries.map(
                                                    (country) => (
                                                        <div
                                                            key={`country_${country.id}`}
                                                            className="flex items-center mb-2"
                                                        >
                                                            <img
                                                                src={`${baseUrl}/storage/${country.flagUrl}`}
                                                                alt=""
                                                                style={{
                                                                    width: 20,
                                                                    marginRight: 10,
                                                                }}
                                                            />
                                                            <InputLabel
                                                                key={country.id}
                                                                className="text-lg text-gray-900 dark:text-gray-200"
                                                            >
                                                                {country.name}
                                                            </InputLabel>
                                                        </div>
                                                    )
                                                )}
                                            </div>
                                        </div>
                                        <div>
                                            <label className="font-bold text-lg">
                                                Company ID
                                            </label>
                                            <p className="mt-1">{company.id}</p>
                                        </div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                Company Name
                                            </label>
                                            <p className="mt-1">
                                                {company.name}
                                            </p>
                                        </div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                Company Industry
                                            </label>
                                            <p className="mt-1">
                                                {company.industry}
                                            </p>
                                        </div>

                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                CompanyType
                                            </label>
                                            <p className="mt-1">
                                                {company.type}
                                            </p>
                                        </div>
                                    </div>
                                    {/* right side of grid */}
                                    <div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                Create Date
                                            </label>
                                            <p className="mt-1">
                                                {company.created_at}
                                            </p>
                                        </div>
                                        <div className="mt-4">
                                            <label className="font-bold text-lg">
                                                Update Date
                                            </label>
                                            <p className="mt-1">
                                                {company.updated_at}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
                <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div className="mb-4 mt-4 items-center px-6">
                        <div className="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-8">
                            <CompanySetup
                                title={"Business Units"}
                                svgImage={
                                    <SvgBusinessUnit
                                        className="w-7 h-7 stroke-green-500"
                                        color="green"
                                    />
                                }
                                target={route(`businessUnit.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Departments"}
                                svgImage={
                                    <SvgDepartment
                                        className="w-7 h-7 stroke-green-500"
                                        color="green"
                                    />
                                }
                                target={route(`department.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Lines"}
                                svgImage={
                                    <SvgLines className="w-7 h-7 stroke-green-500" />
                                }
                                target={route(`line.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Products"}
                                svgImage={
                                    <SvgProduct className="w-7 h-7 stroke-green-500" />
                                }
                                target={route(`product.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />

                            <CompanySetup
                                title={"Regions"}
                                svgImage={
                                    <SvgRegion
                                        className="w-7 h-7 stroke-green-500"
                                        color="green"
                                    />
                                }
                                target={route(`region.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Districts"}
                                svgImage={
                                    <SvgDistrict
                                        className="w-7 h-7 stroke-green-500"
                                        color="green"
                                    />
                                }
                                target={route(`district.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Territories"}
                                svgImage={
                                    <SvgTerritory
                                        className="w-7 h-7 stroke-green-500"
                                        color="green"
                                    />
                                }
                                target={route(`territory.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Offices"}
                                svgImage={
                                    <SvgOffice className="w-7 h-7 stroke-green-500" />
                                }
                                target={route(`office.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Roles"}
                                svgImage={
                                    <SvgRole className="w-7 h-7 stroke-green-500" />
                                }
                                target={route(`role.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Users"}
                                svgImage={
                                    <SvgUser className="w-7 h-7 stroke-green-500" />
                                }
                                target={route(`user.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                            <CompanySetup
                                title={"Structure"}
                                svgImage={
                                    <SvgStructure className="w-7 h-7 stroke-green-500" />
                                }
                                target={route(`user.index`, company.id)}
                                description={` Laravel has wonderful documentation covering `}
                            />
                        </div>
                    </div>
                </div>
                <div className="mt-4 text-right">
                    <Link
                        href={route("company.index")}
                        className="inline-block bg-gray-100 py-1 px-3 text-gray-800 rounded shadow transition-all horver:bg-gray-200 mr-2"
                    >
                        Cancel
                    </Link>
                </div>
            </div>
        </AuthenticatedAdmin>
    );
}
