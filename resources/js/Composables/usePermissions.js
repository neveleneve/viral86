import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

export function usePermissions() {
    const page = usePage();

    const permissions = computed(
        () => page.props.auth?.user?.permissions || [],
    );

    const can = (permission) => {
        return permissions.value.includes(permission);
    };

    const canAny = (permissionArray) => {
        return permissionArray.some((p) => permissions.value.includes(p));
    };

    const canAll = (permissionArray) => {
        return permissionArray.every((p) => permissions.value.includes(p));
    };

    return { can, canAny, canAll };
}
