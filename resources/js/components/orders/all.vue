<template>
  <main role="main" class="main-content">
    <div v-if="loading">
      <div><loadingPage /></div>
    </div>
    <div class="container-fluid">
      <h2 class="h5 page-title pb-5">كل الطلبات</h2>

      <table class="table mt-5 table-hover">
        <thead style="background-color: #0c88c8">
          <tr>
            <th scope="col">#</th>
            <th scope="col">الإسم</th>
            <th scope="col">البريد الالكتروني</th>
            <th scope="col">الرقم</th>
            <th scope="col">وصف الطلب</th>
            <th scope="col">المجال</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(order, index) in orders" :key="order.id">
            <td scope="row">{{ index + 1 }}</td>
            <td>{{ order.name }}</td>
            <td>{{ order.email }}</td>
            <td>{{ order.number }}</td>
            <td>{{ order.desc }}</td>
            <td>{{ order.field }}</td>
            <td class="actions">
              <button type="button" @click="delCat(order.id)">
                <i class="fe fe-trash fe-16"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- pagination -->
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
          <li
            class="page-item"
            v-for="link in pagination.links"
            :key="link"
            v-bind:class="[{ disabled: !link.url }, { haha: link.active }]"
          >
            <a
              class="page-link"
              href="#"
              v-html="link.label"
              @click="fetchorders(link.url)"
            ></a>
          </li>
        </ul>
      </nav>
    </div>
  </main>
</template>

<script>
import loadingPage from "../layouts/laoding.vue";
import axios from "axios";

export default {
  name: "orders",
  components: { loadingPage },
  data() {
    return {
      orders: [],
      loading: false,
      pagination: {},
    };
  },
  mounted() {
    this.fetchorders();
  },
  methods: {
    delCat(id) {
      this.$swal
        .fire({
          title: "هل انت متأكد؟",
          text: "لن تتمكن من إعادة هذه الخطوة!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "نعم إحذف",
          cancelButtonText: "الغاء",
        })
        .then((result) => {
          if (result.isConfirmed) {
            axios.post(`/api/dash/order/destroy/${id}`);
            this.$swal.fire("تم!", "تم الحذف بنجاح", "success");
            this.fetchorders();
          }
        });
    },

    async fetchorders(page_url) {
      this.loading = true;
      page_url = page_url || `api/dash/orders`;
      await axios
        .get(page_url)
        .then((res) => {
          this.orders = res.data.data;
          this.makePagination(res.data.meta);
        })
        .catch(() => {
          this.$router.push({ name: "serverErr" });
        });
      this.loading = false;
    },

    async makePagination(meta) {
      let pagination = {
        links: meta.links,
      };
      this.pagination = pagination;
    },
  },
};
</script>

<style></style>
