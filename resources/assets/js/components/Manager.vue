<template>
    <form @submit.prevent="addArticle" class="mb-3">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Title" v-model="article.title">
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Body" v-model="article.body"></textarea>
      </div>
      <button type="submit" class="btn btn-light btn-block">Save</button>
    </form>
</template>
