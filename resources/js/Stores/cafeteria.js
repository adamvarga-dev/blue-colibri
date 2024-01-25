import { defineStore } from "pinia";
import { ref } from "vue";

export const useCafeteriaStore = defineStore("cafeteria", {
    state: () => ({
        firstColumn: Array(12).fill(0),
        secondColumn: Array(12).fill(0),
        thirdColumn: Array(12).fill(0),
        firstSubTotal: ref(0),
        secondSubTotal: ref(0),
        thirdSubTotal: ref(0),
        total: ref(0),
    }),
    getters: {
        getFirstColumn: (state) => state.firstColumn,
        getSecondColumn: (state) => state.secondColumn,
        getThirdColumn: (state) => state.thirdColumn,
        getFirstSubTotal: (state) => state.firstSubTotal,
        getSecondSubTotal: (state) => state.secondSubTotal,
        getThirdSubTotal: (state) => state.thirdSubTotal,
        getTotal: (state) => state.total,
    },
    actions: {
        setFirstColumnValues(months) {
            this.firstColumn = months.map(function (month) {
                return month.value;
            });
        },
        setSecondColumnValues(months) {
            this.secondColumn = months.map(function (month) {
                return month.value;
            });
        },
        setThirdColumnValues(months) {
            this.thirdColumn = months.map(function (month) {
                return month.value;
            });
        },
        setFirstSubTotal(subTotal) {
            this.firstSubTotal = subTotal;
        },
        setSecondSubTotal(subTotal) {
            this.secondSubTotal = subTotal;
        },
        setThirdSubTotal(subTotal) {
            this.thirdSubTotal = subTotal;
        },
        setTotal() {
            this.total =
                this.firstSubTotal + this.secondSubTotal + this.thirdSubTotal;
        },
    },
});
