export const formatViewCount = (views) => {
    if (!views) return "0";

    if (views >= 1000000000) {
        return (views / 1000000000).toFixed(1).replace(/\.0$/, "") + "b";
    }
    if (views >= 1000000) {
        return (views / 1000000).toFixed(1).replace(/\.0$/, "") + "m";
    }
    if (views >= 1000) {
        return (views / 1000).toFixed(1).replace(/\.0$/, "") + "k";
    }

    return views.toString();
};
