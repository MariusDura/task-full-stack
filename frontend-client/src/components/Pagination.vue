<template>
  <div class="pagination">
    <a v-if="page > 1" @click="page--"> << </a>
    <a v-if="page >= 1"
       :class="page === 1 ? 'active' : ''"
       @click="page = 1"
    >
      1
    </a>
    <span v-if="page > 4">...</span>
    <a v-if="pageNumber > 1"
       :class="page === pageNumber ? 'active' : ''"
       v-for="pageNumber in pages.slice(
              page >= 3  ? page-3 : page-1,
              page + 2 < pages.length ? page + 2 : pages.length-1
            )"
       @click="page = pageNumber"
    >
      {{pageNumber}}
    </a>
    <span v-if="page + 3 < pages.length">...</span>
    <a
      v-if="pages.length > 1"
      :class="page === pages.length ? 'active' : ''"
      @click="page = pages.length"
      class="btn btn-sm btn-outline-secondary"
    >
      {{pages.length}}
    </a>
    <a @click="page++" v-if="page < pages.length"> >> </a>
  </div>
</template>

<script>
  import {mapGetters, mapActions} from 'vuex';

  export default {
    data() {
      return {
        page: 1,
        perPage: 10,
        pages: [],
      }
    },
    computed: {
      ...mapGetters({
        users: 'users'
      })
    },
    created() {
      this.setPages();
      this.paginate();
    },
    methods: {
      ...mapActions({
        setDisplayedUsers: 'setDisplayedUsers'
      }),
      setPages() {
        let numberOfPages = Math.ceil(this.users.length / this.perPage);
        for (let index = 1; index <= numberOfPages; index++) {
          this.pages.push(index);
        }
      },
      paginate() {
        let page = this.page;
        let perPage = this.perPage;
        let from = (page * perPage) - perPage;
        let to = (page * perPage);

        this.setDisplayedUsers({from, to});
      }
    },
    watch: {
      page() {
        this.paginate();
      }
    }
  }
</script>
<style>
  .pagination {
    display: flex;
    justify-content: center;
    margin-top: 0.75rem;
  }

  .pagination a {
    color: black;
    font-size: 14px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    border-radius: 50%;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;

  }

  @media (max-width: 481px) {
    .pagination a {
      width: 25px;
      height: 25px;
      line-height: 25px;
      font-size: 12px;
    }
  }

  .pagination span {
    display: flex;
    align-items: flex-end;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
  }

  .pagination a.active {
    background-color: #4CAF50;
    color: white;
    border: 1px solid #4CAF50;
  }

  .pagination a:hover:not(.active) {
    background-color: #ddd;
    cursor: pointer
  }
</style>
